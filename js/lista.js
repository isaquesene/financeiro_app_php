const todoForm = document.querySelector("#todo-form"),
    todoInput = document.querySelector("#todo-input"),
    todoList = document.querySelector("#todo-list"),
    editForm = document.querySelector("#edit-form"),
    editInput = document.querySelector("#edit-input"),
    cancelEditBtn = document.querySelector("#cancel-edit-btn")

const saveTodo = (text) =>{
    const todo = document.createElement("div");
    todo.classList.add("todo");

    const todoTitle = document.createElement("h3");
    todoTitle.innerHTML = text;
    todo.appendChild(todoTitle);

    const doneBtn = document.createElement("button");
    doneBtn.classList.add("finish-todo");
    doneBtn.innerHTML = `<ion-icon name="checkmark-outline"></ion-icon>`;
    todo.appendChild(doneBtn);

    const editBtn = document.createElement("button");
    editBtn.classList.add("edit-todo");
    editBtn.innerHTML = `<ion-icon name="pencil-outline"></ion-icon>`;
    todo.appendChild(editBtn);

    const deleteBtn = document.createElement("button");
    deleteBtn.classList.add("remove-todo");
    deleteBtn.innerHTML = `<ion-icon name="trash-outline"></ion-icon>`;
    todo.appendChild(deleteBtn);

    todoList.appendChild(todo);

    todoInput.value = "";
    todoInput.focus();

    //console.log(todo)
};


todoForm.addEventListener("submit", (e) =>{
    e.preventDefault();

    const inputValue = todoInput.value;

    if(inputValue){
        saveTodo(inputValue)
    }
});