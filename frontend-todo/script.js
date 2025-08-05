// === dom elements ===
const taskinput = document.getElementById('taskinput');
const addtaskbtn = document.getElementById('addtaskbtn');
const showtasksbtn = document.getElementById('showtasksbtn');
const deletetaskbtn = document.getElementById('deletetaskbtn');
const updatetaskbtn = document.getElementById('updatetaskbtn');
const markcompletedbtn = document.getElementById('markcompletedbtn');
const tasklist = document.getElementById('tasklist');

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

// === show tasks ===
function showtasks() {
  const tasks = [...tasklist.querySelectorAll('li span')].map(span => span.textContent);
  alert(tasks.length ? tasks.join('\n') : 'no tasks available.');
}
showtasksbtn.addEventListener('click', showtasks);

// === delete tasks ===
function deletetask() {
  const selectedtasks = tasklist.querySelectorAll('input[type="checkbox"]:checked');
  if (!selectedtasks.length) return alert('please select a task to delete.');
  selectedtasks.forEach(checkbox => checkbox.closest('li').remove());
}
deletetaskbtn.addEventListener('click', deletetask);

// === update task ===
function updatetask() {
  const selectedtasks = tasklist.querySelectorAll('input[type="checkbox"]:checked');
  if (selectedtasks.length !== 1) return alert('please select exactly one task to update.');
  const span = selectedtasks[0].closest('li').querySelector('span');
  const newtext = prompt('edit task:', span.textContent);
  if (newtext !== null && newtext.trim() !== '') {
    span.textContent = newtext.trim();
  }
}
updatetaskbtn.addEventListener('click', updatetask);

// === mark completed ===
function markcompleted() {
  const selectedtasks = tasklist.querySelectorAll('input[type="checkbox"]:checked');
  if (!selectedtasks.length) return alert('please select a task to mark as completed.');
  selectedtasks.forEach(checkbox => {
    const span = checkbox.closest('li').querySelector('span');
    span.classList.toggle('completed');
  });
}
markcompletedbtn.addEventListener('click', markcompleted);