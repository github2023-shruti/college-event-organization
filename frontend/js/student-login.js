document.getElementById('loginBtn').addEventListener('click', async () => {
  const email = getInputValue('email');
  const password = getInputValue('password');
  setText('msg', '');
  try {
    const r = await apiFetch('/student/login.php', { body: { email, password } });
    setText('msg', r.message || 'Logged in');
    setTimeout(() => redirect('student-dashboard.html'), 300);
  } catch (e) {
    setText('msg', e.message);
  }
});
