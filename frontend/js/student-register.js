document.getElementById('registerBtn').addEventListener('click', async () => {
  const name = getInputValue('name');
  const email = getInputValue('email');
  const password = getInputValue('password');
  setText('msg', '');
  try {
    const r = await apiFetch('/student/register.php', { body: { name, email, password } });
    setText('msg', r.message || 'Registered');
    setTimeout(() => redirect('student-login.html'), 800);
  } catch (e) {
    setText('msg', e.message);
  }
});
