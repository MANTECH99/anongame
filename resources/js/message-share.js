// Direct-canvas card renderer. Fully deterministic (no html-to-image / SVG
// foreignObject quirks, works on iOS). Portrait status-style card:
//   header (message "?" icon + "Bienvenue sur AnonGame") -> message (no white bg)
//   -> (reply at bottom) | footer
const W = 440;
const SCALE = 2;
const PAD = 26;
const RADIUS = 30;
const MIN_MSG_AREA = 320; // keep the card portrait even for short messages

function roundRect(ctx, x, y, w, h, r) {
    ctx.beginPath();
    ctx.moveTo(x + r, y);
    ctx.arcTo(x + w, y, x + w, y + h, r);
    ctx.arcTo(x + w, y + h, x, y + h, r);
    ctx.arcTo(x, y + h, x, y, r);
    ctx.arcTo(x, y, x + w, y, r);
    ctx.closePath();
}

function wrap(ctx, text, maxWidth) {
    const words = String(text).split(/\s+/).filter(Boolean);
    const lines = [];
    let line = '';
    for (const w of words) {
        if (ctx.measureText(w).width > maxWidth) {
            if (line) {
                lines.push(line);
                line = '';
            }
            let cur = '';
            for (const ch of w) {
                if (ctx.measureText(cur + ch).width > maxWidth && cur) {
                    lines.push(cur);
                    cur = ch;
                } else {
                    cur += ch;
                }
            }
            line = cur;
            continue;
        }
        const t = line ? line + ' ' + w : w;
        if (ctx.measureText(t).width > maxWidth && line) {
            lines.push(line);
            line = w;
        } else {
            line = t;
        }
    }
    if (line) lines.push(line);
    return lines;
}

function font(weight, size) {
    return `${weight} ${size}px Figtree, ui-sans-serif, system-ui, -apple-system, sans-serif`;
}

function generateCardCanvas({ message = '', sender = '', reply = null, withFooter = true }) {
    const headerH = 160;
    const msgSize = 20;
    const msgLh = 32;
    const msgTopPad = 14;
    const msgSidePad = 30;
    const replySize = 20;
    const replyLh = 32;
    const replyLabelH = 24;
    const footH = withFooter ? 62 : 0;
    const maxW = W - msgSidePad * 2;

    const meas = document.createElement('canvas').getContext('2d');
    meas.font = font(500, msgSize);
    const msgLines = wrap(meas, message, maxW);
    const msgTextH = msgLines.length * msgLh;
    const msgAreaH = Math.max(msgTextH + msgTopPad * 2, MIN_MSG_AREA);

    let replyLines = [];
    let replyH = 0;
    if (reply !== null && reply !== undefined && String(reply).trim()) {
        meas.font = font(500, replySize);
        replyLines = wrap(meas, reply, maxW);
        replyH = 28 + replyLabelH + replyLines.length * replyLh;
    }

    const H = headerH + msgAreaH + replyH + footH;

    const canvas = document.createElement('canvas');
    canvas.width = W * SCALE;
    canvas.height = H * SCALE;
    const ctx = canvas.getContext('2d');
    ctx.scale(SCALE, SCALE);

    // rounded clip
    roundRect(ctx, 0, 0, W, H, RADIUS);
    ctx.save();
    roundRect(ctx, 0, 0, W, H, RADIUS);
    ctx.clip();

    // full-card vertical gradient (NO white background)
    const grad = ctx.createLinearGradient(0, 0, 0, H);
    grad.addColorStop(0, '#e11d48');
    grad.addColorStop(0.55, '#db2777');
    grad.addColorStop(1, '#6d28d9');
    ctx.fillStyle = grad;
    ctx.fillRect(0, 0, W, H);

    // decorative circles
    ctx.fillStyle = 'rgba(255,255,255,0.12)';
    ctx.beginPath();
    ctx.arc(W - 6, 24, 58, 0, Math.PI * 2);
    ctx.fill();
    ctx.beginPath();
    ctx.arc(6, H - 40, 64, 0, Math.PI * 2);
    ctx.fill();

    // message icon (white bubble, violet "?")
    const badge = 60;
    const bx = (W - badge) / 2;
    const by = 24;
    ctx.fillStyle = '#ffffff';
    roundRect(ctx, bx, by, badge, badge, 18);
    ctx.fill();
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.font = font(800, 36);
    ctx.fillStyle = '#7c3aed';
    ctx.fillText('?', W / 2, by + badge / 2 + 2);

    // header texts
    ctx.font = font(800, 21);
    ctx.fillStyle = '#ffffff';
    ctx.fillText('Bienvenue sur AnonGame', W / 2, by + badge + 32);
    ctx.font = font(500, 13);
    ctx.fillStyle = 'rgba(255,255,255,0.85)';
    const sub =
        sender && sender !== 'Anonyme' ? 'Message de ' + sender : 'Message anonyme';
    ctx.fillText(sub, W / 2, by + badge + 56);

    // message body (on the gradient, white text, larger + centered)
    if (msgLines.length) {
        ctx.textAlign = 'center';
        ctx.textBaseline = 'top';
        ctx.font = font(600, msgSize);
        ctx.fillStyle = '#ffffff';
        let my = headerH + msgTopPad;
        for (const line of msgLines) {
            ctx.fillText(line, W / 2, my);
            my += msgLh;
        }
    }

    // reply block (bottom) - only when replying
    if (reply !== null && reply !== undefined && String(reply).trim()) {
        let by2 = H - footH - replyH;
        ctx.fillStyle = 'rgba(255,255,255,0.10)';
        ctx.fillRect(0, by2, W, replyH);
        ctx.strokeStyle = 'rgba(255,255,255,0.25)';
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(0, by2 + 0.5);
        ctx.lineTo(W, by2 + 0.5);
        ctx.stroke();
        by2 += 18;
        ctx.textAlign = 'left';
        ctx.textBaseline = 'top';
        ctx.font = font(800, 11);
        ctx.fillStyle = 'rgba(255,255,255,0.7)';
        ctx.fillText('TA R\u00c9PONSE', PAD, by2);
        by2 += replyLabelH;
        ctx.font = font(600, replySize);
        ctx.fillStyle = '#ffffff';
        ctx.textAlign = 'center';
        for (const line of replyLines) {
            ctx.fillText(line, W / 2, by2);
            by2 += replyLh;
        }
    }

    // footer (download only)
    if (withFooter) {
        const fy = H - footH;
        ctx.strokeStyle = 'rgba(255,255,255,0.25)';
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(PAD, fy + 0.5);
        ctx.lineTo(W - PAD, fy + 0.5);
        ctx.stroke();
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.font = font(800, 11);
        ctx.fillStyle = 'rgba(255,255,255,0.75)';
        ctx.fillText('ANONGAME \u00b7 QUIZ \u00b7 DEVINETTES', W / 2, fy + 24);
        ctx.font = font(500, 10);
        ctx.fillStyle = 'rgba(255,255,255,0.5)';
        ctx.fillText('Jouer n\u2019a jamais \u00e9t\u00e9 aussi anonyme', W / 2, fy + 42);
    }

    ctx.restore();
    return canvas;
}

function fromNode(sourceNode, reply, withFooter) {
    const message = (sourceNode && sourceNode.dataset.message) || '';
    const sender = (sourceNode && sourceNode.dataset.sender) || '';
    return generateCardCanvas({ message, sender, reply, withFooter });
}

function canvasToFile(canvas, fileName) {
    return new Promise((resolve, reject) => {
        canvas.toBlob(
            (blob) => {
                if (!blob) return reject(new Error('canvas.toBlob (bled)'));
                resolve(new File([blob], fileName || 'message-anongame.png', { type: 'image/png' }));
            },
            'image/png'
        );
    });
}

export function downloadMessageImage(sourceNode, fileName = 'message-anongame.png') {
    const canvas = fromNode(sourceNode, null, true);
    const link = document.createElement('a');
    link.download = fileName;
    link.href = canvas.toDataURL('image/png');
    link.click();
}

export async function shareMessageImage(sourceNode, { reply = null, fileName = 'message-anongame.png' } = {}) {
    const canvas = fromNode(sourceNode, reply, false);
    const file = await canvasToFile(canvas, fileName);

    if (navigator.share && navigator.canShare && navigator.canShare({ files: [file] })) {
        await navigator.share({
            files: [file],
            title: 'AnonGame',
            text: 'Message AnonGame',
        });
        return 'shared';
    }

    const url = URL.createObjectURL(file);
    const a = document.createElement('a');
    a.download = fileName;
    a.href = url;
    a.click();
    URL.revokeObjectURL(url);
    return 'downloaded';
}
