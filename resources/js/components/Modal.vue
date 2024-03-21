<script setup>
import { ref , defineProps } from 'vue';
import axios from 'axios';

const props = defineProps({
  handleClick: Function,
  errors: Array
});

const formData = ref({
  name: '',
  email: '',
  phone: '',
  picture: null,
});

const handleFileChange = (event) => {
  const file = event.target.files[0];
  formData.value.picture = file;
};
</script>
<template>
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar um novo cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3" >
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input v-model="formData.name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div v-if="errors?.name !== undefined" class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ errors?.name !== undefined && errors?.name[0] }}
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input v-model="formData.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div v-if="errors?.email !== undefined" class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ errors?.email !== undefined && errors?.email[0] }}
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Telefone</label>
                        <input v-model="formData.phone" type="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div v-if="errors?.phone !== undefined" class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ errors?.phone !== undefined && errors?.phone[0] }}
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Foto</label>
                        <input @change="handleFileChange" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div v-if="errors?.picture !== undefined" class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ errors?.picture !== undefined && errors?.picture[0] }}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">fechar</button>
                <button @click="props.handleClick(formData)"  >criar</button>
            </div>
        </div>
    </div>
</div>
</template>