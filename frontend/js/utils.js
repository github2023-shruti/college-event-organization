const API_BASE = (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1')
  ? '/backend/api'
  : '/api';

async function apiFetch(path, options = {}) {
  const res = await fetch(`${API_BASE}${path}`, {
    method: options.method || 'POST',
    headers: { 'Content-Type': 'application/json' },
    credentials: 'include',
    body: options.body ? JSON.stringify(options.body) : undefined,
  });
  const data = await res.json().catch(() => ({ success: false, message: 'Invalid JSON' }));
  if (!res.ok || data.success === false) {
    const msg = data.message || `Request failed (${res.status})`;
    throw new Error(msg);
  }
  return data;
}

function getInputValue(id) { return document.getElementById(id).value.trim(); }
function setText(id, text) { const el = document.getElementById(id); if (el) el.textContent = text; }
function setHTML(id, html) { const el = document.getElementById(id); if (el) el.innerHTML = html; }
function on(el, ev, cb) { el.addEventListener(ev, cb); }

function redirect(path) { window.location.href = path; }
