// Direct-canvas card renderer. Fully deterministic (no html-to-image / SVG
// foreignObject quirks, works on iOS). Draws:
//   header (logo + "Bienvenue sur AnonGame") -> message -> (reply at bottom) | footer
const W = 500;
const SCALE = 2;
const PAD = 28;
const RADIUS = 28;

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
    const headerH = 176;
    const msgSize = 16;
    const msgLh = 25;
    const replySize = 16;
    const replyLh = 25;
    const replyLabelH = 22;
    const footH = withFooter ? 62 : 0;
    const maxW = W - PAD * 2;

    const meas = document.createElement('canvas').getContext('2d');
    meas.font = font(500, msgSize);
    const msgLines = wrap(meas, message, maxW);
    const msgH = msgLines.length * msgLh;

    let replyLines = [];
    let replyH = 0;
    if (reply !== null && reply !== undefined && String(reply).trim()) {
        meas.font = font(500, replySize);
        replyLines = wrap(meas, reply, maxW);
        replyH = 26 + replyLabelH + replyLines.length * replyLh;
    }

    const bodyPad = msgLines.length ? 30 : 0;
    const bodyH = msgLines.length ? bodyPad + msgH + bodyPad : 0;
    const H = headerH + bodyH + replyH + footH;

    const canvas = document.createElement('canvas');
    canvas.width = W * SCALE;
    canvas.height = H * SCALE;
    const ctx = canvas.getContext('2d');
    ctx.scale(SCALE, SCALE);

    // white rounded card + rounded clip
    roundRect(ctx, 0, 0, W, H, RADIUS);
    ctx.fillStyle = '#ffffff';
    ctx.fill();
    ctx.save();
    roundRect(ctx, 0, 0, W, H, RADIUS);
    ctx.clip();

    // header gradient
    const grad = ctx.createLinearGradient(0, 0, 0, headerH);
    grad.addColorStop(0, '#e11d48');
    grad.addColorStop(0.5, '#db2777');
    grad.addColorStop(1, '#7e22ce');
    ctx.fillStyle = grad;
    ctx.fillRect(0, 0, W, headerH);

    // decorative circles
    ctx.fillStyle = 'rgba(255,255,255,0.10)';
    ctx.beginPath();
    ctx.arc(W - 4, 16, 54, 0, Math.PI * 2);
    ctx.fill();
    ctx.beginPath();
    ctx.arc(10, headerH - 10, 60, 0, Math.PI * 2);
    ctx.fill();

    // logo badge
    const badge = 58;
    const badgeX = (W - badge) / 2;
    const badgeY = 18;
    ctx.fillStyle = '#ffffff';
    roundRect(ctx, badgeX, badgeY, badge, badge, 16);
    ctx.fill();
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.font = font(400, 30);
    ctx.fillText('\u{1F3AE}', W / 2, badgeY + badge / 2 + 2);

    // header texts
    ctx.font = font(800, 22);
    ctx.fillStyle = '#ffffff';
    ctx.fillText('Bienvenue sur AnonGame', W / 2, badgeY + badge + 30);
    ctx.font = font(500, 13);
    ctx.fillStyle = 'rgba(255,255,255,0.85)';
    const sub =
        sender && sender !== 'Anonyme' ? 'Message de ' + sender : 'Message anonyme';
    ctx.fillText(sub, W / 2, badgeY + badge + 52);

    // message body
    if (msgLines.length) {
        ctx.textAlign = 'left';
        ctx.textBaseline = 'top';
        ctx.font = font(500, msgSize);
        ctx.fillStyle = '#1f2937';
        let my = headerH + bodyPad;
        for (const line of msgLines) {
            ctx.fillText(line, PAD, my);
            my += msgLh;
        }
    }

    // reply block (bottom, before footer) - only when replying
    if (reply !== null && reply !== undefined && String(reply).trim()) {
        let by = H - footH - replyH;
        ctx.fillStyle = '#fdf2f5';
        ctx.fillRect(0, by, W, replyH);
        ctx.strokeStyle = '#f6e0e6';
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(0, by + 0.5);
        ctx.lineTo(W, by + 0.5);
        ctx.stroke();
        by += 18;
        ctx.textAlign = 'left';
        ctx.textBaseline = 'top';
        ctx.font = font(800, 11);
        ctx.fillStyle = '#e11d48';
        ctx.fillText('Ta r\u00e9ponse', PAD, by);
        by += replyLabelH;
        ctx.font = font(500, replySize);
        ctx.fillStyle = '#9f1239';
        for (const line of replyLines) {
            ctx.fillText(line, PAD, by);
            by += replyLh;
        }
    }

    // footer (download only)
    if (withFooter) {
        const fy = H - footH;
        ctx.strokeStyle = '#f3f4f6';
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(PAD, fy + 0.5);
        ctx.lineTo(W - PAD, fy + 0.5);
        ctx.stroke();
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.font = font(800, 11);
        ctx.fillStyle = '#9ca3af';
        ctx.fillText('ANONGAME \u00b7 QUIZ \u00b7 DEVINETTES', W / 2, fy + 22);
        ctx.font = font(500, 10);
        ctx.fillStyle = '#d1d5db';
        ctx.fillText('Jouer n\u2019a jamais \u00e9t\u00e9 aussi anonyme', W / 2, fy + 40);
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
