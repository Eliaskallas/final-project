// === dom elements ===
const taskinput = document.getElementById('taskinput');
const addtaskbtn = document.getElementById('addtaskbtn');

// === add task ===
function addtask() {
  const text = taskinput.value.trim();
  if (!text) return alert('please enter a task.');

  const li = document.createElement('li');

  const checkbox = document.createElement('input');
  checkbox.type = 'checkbox';

  const span = document.createElement('span');
  span.textContent = text;
  span.style.marginLeft = '8px';

  li.appendChild(checkbox);
  li.appendChild(span);
  tasklist.appendChild(li);

  taskinput.value = '';
}

// === add task on enter key ===
taskinput.addEventListener('keypress', function (e) {
  if (e.key === 'Enter') {
    e.preventDefault();
    addtask();
  }
});

addtaskbtn.addEventListener('click', addtask);