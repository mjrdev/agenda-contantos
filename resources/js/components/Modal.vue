<script setup>
import { ref , defineProps, watch } from 'vue';

const props = defineProps({
  handleClick: Function,
  errors: Array,
  modalId: {
    type: String,
    default: "myModal"
  },
  itemSelected: {
    Object,
    default: {
        id: 0,
        name: '',
        email: '',
        phone: ''   
    }
  }
});

const formData = ref({
  name: '',
  email: '',
  phone: '',
});

const handleFileChange = (event) => {
  const file = event.target.files[0];
  formData.value.picture = file;
};

watch(() => props.itemSelected.id, (newValue, oldValue) => {
    if(props.modalId === "myModalEdit") {
        formData.value.name = props.itemSelected.name;
        formData.value.email = props.itemSelected.email;
        formData.value.phone = props.itemSelected.phone;
    }

    console.log(props.itemSelected);
});
</script>
<template>
<div class="modal fade" :id="modalId" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{
                        modalId === "myModal"  ? "Criar um novo cliente" : "Editar um cliente"
                    }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-1" >
                        <label for="exampleInputEmail1" class="form-label">Nome do contato</label>
                        <input v-model="formData.name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <span v-if="errors?.name !== undefined" class="text-danger">
                        {{ errors?.name !== undefined && errors?.name[0] }}
                    </span>
                    
                    <div class="mb-1">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input v-model="formData.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <span v-if="errors?.email !== undefined" class="text-danger">
                        {{ errors?.email !== undefined && errors?.email[0] }}
                    </span>

                    <div class="mb-1">
                        <label for="exampleInputEmail1" class="form-label">Telefone</label>
                        <input v-mask-phone.br maxlength="15" name="phone" v-model="formData.phone" type="text " class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>  

                    <span v-if="errors?.phone !== undefined" class="text-danger">
                        {{ errors?.phone !== undefined && errors?.phone[0] }}
                    </span>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">fechar</button>
                <button @click="props.handleClick(formData)">
                    {{
                        modalId === "myModal"  ? "criar" : "editar"
                    }}
                </button>
            </div>
        </div>
    </div>
</div>
</template>