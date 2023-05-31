const form = document.querySelector('#filmesForm')
const tituloInput = document.querySelector('#tituloInput')
const autorInput = document.querySelector('#autorInput')
const ano_publicacaoInput = document.querySelector('#ano_publicacaoInput')
const URL = 'http://localhost:8080/hotel.php'

const tableBody = document.querySelector('#hotelTable')

function carregarFilmes() {
    fetch(URL, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
        mode: 'cors'
    })
        .then(response => response.json())
        .then(hotel => {
            tableBody.innerHTML = ''

            for (let i = 0; i < hotel.length; i++) {
                const tr = document.createElement('tr')
                const hotel = hotel[i]
                tr.innerHTML = `
                    <td>${hotel.id}</td>
                    <td>${hotel.titulo}</td>
                    <td>${hotel.autor}</td>
                    <td>${hotel.ano_publicacao}</td>
                    <td>
                        <button data-id="${hotel.id}" onclick="atualizarHotel(${hotel.id})">Editar</button>
                        <button onclick="excluirHotel(${hotel.id})">Excluir</button>
                    </td>
                `
                tableBody.appendChild(tr)
            }

        })
}

//função para criar um hotel
function adicionarHotel(event) {

    event.preventDefault()

    const titulo = tituloInput.value
    const autor = autorInput.value
    const ano_publicacao = ano_publicacaoInput.value

    fetch(URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `titulo=${encodeURIComponent(titulo)}&autor=${encodeURIComponent(autor)}&ano_publicacao=${encodeURIComponent(ano_publicacao)}`
    })
        .then(response => {
            if (response.ok) {
                carregarFilmes()
                tituloInput.value = ''
                autorInput.value = ''
                ano_publicacaoInput.value = ''
            } else {
                console.error('Erro ao add filme')
                alert('Erro ao add Filme')
            }
        })
}

function atualizarFilmes(id){
    const novoTitulo = prompt("Digite o novo Título")
    const novoDiretor = prompt("Digite o novo Diretr")
    const novoAno = prompt("Digite o novo Ano de Lançamento")
    const novoGenero = prompt("Digite o novo Gênero")
   
    if (novoTitulo && novoAno && novoAutor){
        fetch(`${URL}?id=${id}`,{
            method: 'PUT',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `titulo=${encodeURIComponent(novoTitulo)}&autor=${encodeURIComponent(novoAutor)}&ano_publicacao=${encodeURIComponent(novoAno)}`
        })
            .then(response => {
                if(response.ok){
                    carregarFilmes()
                } else {
                    console.error('Erro ao att filme')
                    alert('erro ao att filme')
                }
            })
    }
}

function excluirFilme(id){
    if(confirm('Deseja excluir esse filme?')){
        fetch(`${URL}?id=${id}`, {
            method: 'DELETE'
        })
        .then(response => {
                if (response.ok) {
                carregarFilmes()
                } else {
                console.error('Error ao excluir Filme')
                alert('Erro ao excluir Filme')
             }
        })
    }
}



form.addEventListener('submit', adicionarFilme)

carregarFilmes()
