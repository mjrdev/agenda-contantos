<script setup>
import Modal from '../components/Modal.vue';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import { ref, onMounted } from 'vue'
import api from '../api'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const items = ref([])
const errors = ref([])

onMounted(() => {
    api.get('/contactAgenda')
    .then(res => {
        items.value = res.data
    })
    .catch(err => {})
})

const submitForm = (form) => {
    let formData = new FormData();
    formData.append('name', form.name);
    formData.append('email', form.email);
    formData.append('phone', form.phone);
    formData.append('picture', form.picture);
    
    api.post('contactAgenda', formData)
    .then((response) => {
        alert('ok')
    })
    .catch((error) => {
        errors.value = error.response.data.errors
    });
};  

const headers = [
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
                    <h2>Sua agenda de contanto</h2>
                </div>
                <button type="button" data-bs-toggle="modal" data-bs-target="#myModal">Novo Contatos</button>
            </div>
            <Vue3EasyDataTable
                :headers="headers" :items="items" buttons-pagination
                class="custom-table"
            >
                <template #item-picture="{ picture}">
                    <img href="https://bafkreih3oswhrhrvxwhebuqqnlqtklnth5pbc2q3iv6446icpltt6tymvy.ipfs.dweb.link/?filename=Stephen.png"></img>
                </template>
                <template #item-favorite="{ favorite }">
                    <i v-if="favorite" class="bi bi-star-fill text-warning"></i>
                    <i v-else="favorite" class="bi bi-star"></i>    
                </template>
                <template #item-action="{ favorite }">
                    <div class="d-flex gap-2">
                        <i class="bi bi-pencil-fill"></i>
                        <i class="bi bi-trash-fill"></i>
                    </div>          
                </template>
            </Vue3EasyDataTable>
            <Modal :handle-click="submitForm" :errors="errors"/>
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
</style>