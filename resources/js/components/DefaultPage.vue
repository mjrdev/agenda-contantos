<script setup>
import Modal from '../components/Modal.vue';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import { ref, onMounted } from 'vue'
import api from '../api'

const items = ref([])
const errors = ref([])

onMounted(() => {
    api.get('/contactAgenda')
    .then(res => {
        items.value = res.data
    })
    .catch(err => {
        console.log(err)
    })
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
    { text: "FOTO", value: "picture", sortable: true },
    { text: "NOME", value: "name" },
    { text: "EMAIL", value: "email" },
    { text: "CELULAR", value: "phone" },
    { text: "FAVORITO", value: "favorite", width: '20px' },
];

</script>
<template>
    <div id="main">
        <div class="container">
            <div class="header-container">
                <h2>Sua agenda de contanto</h2>
                <button type="button" data-bs-toggle="modal" data-bs-target="#myModal">Novo Contatos</button>
            </div>
            <Vue3EasyDataTable
                :headers="headers" :items="items" buttons-pagination

            >
                <template #item-picture="{ picture}">
                    <img :href="'https://bafkreih3oswhrhrvxwhebuqqnlqtklnth5pbc2q3iv6446icpltt6tymvy.ipfs.dweb.link/?filename=Stephen.png'"></img>
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
    background-color: #f0f0f0;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
}
</style>