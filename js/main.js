let tableBody = document.querySelector("tbody");
let btnSalvar = document.querySelector(".btn"),
    modals = document.querySelector(".modal-container"),
    addform = document.querySelector(".add form"),
    editform = document.querySelector(".editar form");

var database = firebase.database();
var usersRef = firebase.database().ref('users/');

function writeUserData(descricao, valor, pagamento, categoria, data, tipo) {
   // const db = getDatabase();
   let userId = usersRef.push().key;
    usersRef.child(userId).set({
        descricao: descricao,
        valor: valor,
        pagamento: pagamento,
        categoria: categoria,
        data: data,
        tipo: tipo
    }).then((onFullFilled) =>{
        //alert("Valor Cadastrado!");
        document.querySelector(".add").classList.remove("active");
        addform.reset()
    },(onRejected)=>{
        console.log(onRejected);
    });
}

/*writeUserData(1, "Arroz", "20,00", "cc nun", "29/12/2022")
writeUserData(2, "Pão", "2,00", "cc nun", "29/12/2022")*/
//writeUserData("macarrão", "12,00", "cc nun", "comida", "29/12/2022", "saida")

usersRef.on('value', (snapshot) => {
    const users = snapshot.val();
    tableBody.innerHTML = "";
    //console.log(users);
    //updateStarCount(postElement, data);
    for(user in users)
    {
        //console.log(typeof users[user]);
        //console.log(typeof users);
        let tr = `
        <tr data-id= ${user}>
            <td data-label="Descrição">${users[user].descricao}</td>
            <td data-label="Valor">${users[user].valor}</td>
            <td data-label="Pagamento">${users[user].pagamento}</td>
            <td data-label="Categoria">${users[user].categoria}</td>
            <td data-label="Data">${users[user].data}</td>
            <td data-label="Tipo">${users[user].tipo}</td>
            <td data-label="Ação">
                <button class="edit">Edit</button>
                <button class="delete">Delete</button>
            </td>
        </tr>
        `

        tableBody.innerHTML += tr;
    }

    //editar
    let editButtons = document.querySelectorAll(".edit");
    editButtons.forEach(edit =>{
        edit.addEventListener("click", () =>{
            document.querySelector(".editar").classList.add("active");
            let userId = edit.parentElement.parentElement.dataset.id;
            usersRef.child(userId).get().then((snapshot => {
                //console.log(snapshot.val());
                editform.descricao.value = snapshot.val().descricao;
                editform.valor.value = snapshot.val().valor;
                editform.pagamento.value = snapshot.val().pagamento;
                editform.categoria.value = snapshot.val().categoria;
                editform.data.value = snapshot.val().data;
                editform.tipo.value = snapshot.val().tipo;
            }))
            editform.addEventListener("submit", (e) =>{
                e.preventDefault();
                usersRef.child(userId).update({
                    descricao: editform.descricao.value,
                    valor: editform.valor.value,
                    pagamento: editform.pagamento.value,
                    categoria: editform.categoria.value,
                    data: editform.data.value,
                    tipo: editform.tipo.value
                }).then((onFullFilled) =>{
                    alert("Alterado com sucesso!")
                    document.querySelector(".editar").classList.remove("active");
                    editform.reset()
                },(onRejected)=>{
                    console.log(onRejected);
                });
            })
        })
    })

    // Delete
    let deletButtons = document.querySelectorAll(".delete");

    deletButtons.forEach(deletBtn =>{
        deletBtn.addEventListener("click", () =>{
            let userId = deletBtn.parentElement.parentElement.dataset.id;
            usersRef.child(userId).remove().then(() =>{
                alert("Deletado!");
            })
        })
    })
});

// Open form

btnSalvar.addEventListener("click", () =>{
        document.querySelector(".add").classList.add("active");
        addform.addEventListener("submit", (e) => {
            e.preventDefault();
            writeUserData(addform.descricao.value, addform.valor.value, addform.pagamento.value, 
            addform.categoria.value, addform.data.value, addform.tipo.value)
        })
})


// Close Form
window.addEventListener("click", (e)=>{
    if(e.target == modals)
    {
        modals.classList.remove("active");
        addform.reset();
        editform.reset();
    }
})


function tableSearch(){
    let input, filter, table, tr, td, i, txtValue;
   // console.log("Ola Sene")

   input = document.getElementById("myInput");
   filter = input.value.toUpperCase();
   table = document.getElementById("financeiro");

   tr  = table.getElementsByTagName("tr");

   for(let i = 0; i < tr.length; i++){
    td = tr[i].getElementsByTagName("td")[3];
    if(td){
        txtValue = td.textContent || td.innerText;
        if(txtValue.toUpperCase().indexOf(filter) > -1){
            tr[i].style.display = "";
        }else{
            tr[i].style.display = "none";
        }
    }
   }
}