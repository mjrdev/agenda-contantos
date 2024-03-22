<script setup>
import Modal from '../components/Modal.vue';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import { ref, onMounted } from 'vue'
import api from '../api'
import Swal from 'sweetalert2'

const items = ref([])
const errors = ref([])
const search = ref('')

const itemSelected = ref({
  id: 0,
  name: '',
  email: '',
  phone: '',
  favorite: false
});

function handleContacts() {
    api.get('/contactAgenda?search=' + search.value)
    .then(res => {
        items.value = res.data
    })
    .catch(err => {})
}

function setFavorite(form)
{
    api.put('/contactAgenda/' + form.id, {
        name: form.name,
        email: form.email,
        phone: form.phone.replace(/\D/g, ''),
        favorite: !form.favorite
    })
    .then(res => {
        Swal.fire({
            icon:'success',
            title: 'sucesso!',
            showConfirmButton: false,
            timer: 1000
        })
        handleContacts()
    })
    .catch(err => {})
}

function deleteContact(id) {
    api.delete('/contactAgenda/' + id)
    .then(res => {
        Swal.fire({
            icon:'success',
            title: 'contato deletado com sucesso!',
            showConfirmButton: false,
            timer: 1500
        })
        handleContacts()
    })
    .catch(err => {})
}

function selectToEditContact(form) {
    itemSelected.value.id = form.id
    itemSelected.value.name = form.name
    itemSelected.value.email = form.email
    itemSelected.value.phone = form.phone,
    itemSelected.value.favorite = form.favorite
}

function editContact(form) {
    api.put('/contactAgenda/' + itemSelected.value.id, {
        name: form.name,
        email: form.email,
        phone: form.phone.replace(/\D/g, '')
    })
    .then(res => {
        Swal.fire({
            icon:'success',
            title: 'contato editado com sucesso!',
            showConfirmButton: false,
            timer: 1500
        })
        document.getElementsByClassName('btn-cancel')[0].click();
        handleContacts()
    })
    .catch(err => {})
}

function formatPhone(phone) {
    let cleanedPhone = phone.replace(/\D/g, '');
    if (cleanedPhone.length === 11) {
        return `(${cleanedPhone.substring(0, 2)}) ${cleanedPhone.substring(2, 7)}-${cleanedPhone.substring(7, 11)}`;
    } else {
        return cleanedPhone;
    }
}

onMounted(() => {
    handleContacts()
})  

const submitForm = (form) => {
    let formData = new FormData();
    formData.append('name', form.name);
    formData.append('email', form.email);
    formData.append('phone', form.phone.replace(/\D/g, ''));
    
    api.post('contactAgenda', formData)
    .then(() => {
        Swal.fire({
            title: "Show de bola!",
            text: "contato salvo com sucesso!",
            icon: "success"
        });
            
        document.getElementsByClassName('btn-cancel')[0].click();
        handleContacts();
    })
    .catch((error) => {
        errors.value = error.response.data.errors
    });
};

const headers = [
    { text: "#", value: "id", width: 0 },
    { text: "NOME", value: "name" },
    { text: "EMAIL", value: "email" },
    { text: "CELULAR", value: "phone" },
    { text: "FAVORITO", value: "favorite", width: '20px', align: 'center', sortable: false},
    { text: "AÇÕES", value: "action", sortable: false},
];

</script>
<template>
    <div id="main">
        <div class="container">
            <div class="header-container">
                <div class="title-container">
                    <span class="icon-main">
                        <i class="bi bi-person-lines-fill"></i> 
                    </span>
                    <h2>Contatos</h2>
                </div>
                <button type="button" data-bs-toggle="modal" data-bs-target="#myModal">Novo Contatos</button>
            </div>
            <div class="filter">
                <input @keyup.enter="handleContacts" type="text" class="form-control" placeholder="buscar por: nome, email, celular" v-model="search">
                <button @click="handleContacts" >Buscar</button>
            </div>
            <Vue3EasyDataTable
                :headers="headers" :items="items" buttons-pagination
                class="custom-table"
            >
                <template #item-id="{}">
                    <i class="bi bi-person-rolodex"></i>
                </template>
                <template #item-picture="{ picture}">
                    <img href="https://bafkreih3oswhrhrvxwhebuqqnlqtklnth5pbc2q3iv6446icpltt6tymvy.ipfs.dweb.link/?filename=Stephen.png"></img>
                </template>
                <template #item-favorite="{ id, phone, favorite, name, email }">
                    <i v-if="favorite" class="bi bi-star-fill text-warning" @click="setFavorite({
                        id: id,
                        name: name,
                        email: email,
                        phone: phone,
                        favorite: favorite
                    })"></i>
                    <i v-else="favorite" class="bi bi-star" @click="setFavorite({
                        id: id,
                        name: name,
                        email: email,
                        phone: phone,
                        favorite: favorite
                    })"></i>    
                </template>
                <template #item-action="{ id, phone, favorite, name, email }">
                    <div class="d-flex gap-2">
                        <i class="bi bi-pencil-fill" @click="selectToEditContact({
                            id: id,
                            name: name,
                            email: email,
                            phone: phone,
                            favorite: favorite
                        })" data-bs-toggle="modal" data-bs-target="#myModalEdit"    ></i>
                        <i class="bi bi-trash-fill" @click="deleteContact(id)"></i>
                    </div>          
                </template>
                <template #item-phone="{ phone }">
                    <div class="d-flex gap-2">
                        {{ formatPhone(phone) }} <a target="_blank" :href="'https://wa.me/55' + phone.replace(' ', '')">
                                <i class="bi bi-whatsapp text-success"></i>
                            </a>
                    </div>          
                </template>
            </Vue3EasyDataTable>
            <Modal :handle-click="submitForm" :errors="errors"/>
            <Modal :itemSelected="itemSelected" :handle-click="editContact" :errors="errors" :modal-id="'myModalEdit'"/>
        </div>
    </div>
</template>
<style scoped>
#main {
    max-width: 1200px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    margin: 2rem auto;
}

.container {
    background-color: #f8f8f8;
    box-shadow: 2px 2px 10px #5353536e;
    padding: 20px;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
}

.custom-table {
    --easy-table-body-row-font-size: 18pt;
    --easy-table-body-row-font-color: #272727;
    --easy-table-body-row-background-color: #ffffff;
    --easy-table-body-row-height: 50px;
    --easy-table-body-row-font-size: 16px;

    --easy-table-header-font-size: 14px;
    --easy-table-header-height: 50px;
    --easy-table-header-font-color: #ffffff;
    --easy-table-header-background-color: #1a3576;

    --easy-table-footer-background-color: #1a3576;
    --easy-table-footer-font-color: #ffffff;
    --easy-table-footer-font-size: 14px;
    --easy-table-footer-padding: 0px 10px;
    --easy-table-footer-height: 50px;
}

i {
    cursor: pointer;
}

.icon-main {
    width: 50px;
    height: 50px;
    background-color: #1a3576;
    color: #ffffff;
    font-size: 22px;
    display: flex;
    align-items: center;
    justify-content: center;     
}

.title-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

.filter {
    width: 50%;
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin: 10px 0;
}
</style>