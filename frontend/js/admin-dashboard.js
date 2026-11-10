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
        <div class="nav">
          <button class="button secondary" data-edit="${ev.id}">Edit</button>
          <button class="button" data-del="${ev.id}">Delete</button>
        </div>
      </li>`).join(''));
  } catch (e) {
    setHTML('events', `<li class="list-item">${e.message}</li>`);
  }
}

function readForm() {
  return {
    id: document.getElementById('event_id').value || null,
    title: getInputValue('title'),
    description: getInputValue('description'),
    event_date: getInputValue('event_date'),
    location: getInputValue('location'),
  };
}

function fillForm(ev) {
  document.getElementById('event_id').value = ev.id || '';
  setText('formMsg', 'Editing event');
  document.getElementById('title').value = ev.title || '';
  document.getElementById('description').value = ev.description || '';
  document.getElementById('event_date').value = ev.event_date || '';
  document.getElementById('location').value = ev.location || '';
}

function resetForm() {
  document.getElementById('event_id').value = '';
  document.getElementById('title').value = '';
  document.getElementById('description').value = '';
  document.getElementById('event_date').value = '';
  document.getElementById('location').value = '';
  setText('formMsg', '');
}

document.getElementById('events').addEventListener('click', async (e) => {
  const t = e.target;
  if (t.dataset.edit) {
    const id = Number(t.dataset.edit);
    const items = Array.from(document.querySelectorAll('#events .list-item'));
    const ev = (await apiFetch('/events/get_events.php', { method: 'GET' })).data.find(x => Number(x.id) === id);
    if (ev) fillForm(ev);
  }
  if (t.dataset.del) {
    const id = Number(t.dataset.del);
    if (!confirm('Delete this event?')) return;
    try {
      await apiFetch('/admin/delete_event.php', { body: { id } });
      await loadEvents();
    } catch (err) { alert(err.message); }
  }
});

document.getElementById('saveBtn').addEventListener('click', async () => {
  setText('formMsg', '');
  const payload = readForm();
  try {
    if (payload.id) {
      await apiFetch('/admin/edit_event.php', { body: payload });
    } else {
      await apiFetch('/admin/add_event.php', { body: payload });
    }
    resetForm();
    await loadEvents();
    setText('formMsg', 'Saved');
  } catch (e) { setText('formMsg', e.message); }
});

document.getElementById('resetBtn').addEventListener('click', resetForm);

document.getElementById('logoutBtn').addEventListener('click', async () => {
  try { await apiFetch('/logout.php', { method: 'POST' }); } catch {}
  redirect('admin-login.html');
});

loadEvents();
