async function loadEvents() {
  try {
    const r = await apiFetch('/events/get_events.php', { method: 'GET' });
    const list = r.data || [];
    setText('count', String(list.length));
    setHTML('events', list.map(ev => `
      <li class="list-item">
        <div>
          <div><strong>${ev.title}</strong></div>
          <div class="subtitle">${ev.description || ''}</div>
          <div class="subtitle">${ev.event_date} • ${ev.location || ''}</div>
        </div>
      </li>`).join(''));
  } catch (e) {
    setHTML('events', `<li class="list-item">${e.message}</li>`);
  }
}

document.getElementById('logoutBtn').addEventListener('click', async () => {
  try { await apiFetch('/logout.php', { method: 'POST' }); } catch {}
  redirect('student-login.html');
});

loadEvents();
