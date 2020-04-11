<template>
    <div>
        <div class="flex items-center justify-between">
            <a href="#" class="text-blue-400" @click="$router.back()">
                Back
            </a>
        </div> 
        
    
        <form class="mt-8" @submit.prevent="editContact">
            <InputField :data="editForm.name" name="name" label="Name" placeholder="Contact Name" :errors="errors" @updatingField="editForm.name = $event"/>
            <InputField :data="editForm.email" name="email" label="Email" placeholder="Contact Email" :errors="errors" @updatingField="editForm.email = $event"/>
            <InputField :data="editForm.company" name="company" label="Company" placeholder="Contact Company" :errors="errors" @updatingField="editForm.company = $event"/>
            <InputField :data="editForm.birthday" name="birthday" label="Birthday" placeholder="mm/dd/yyyy" :errors="errors" @updatingField="editForm.birthday = $event"/>

            <div class="flex justify-end">
                <button class="rounded text-white py-2 px-4 bg-blue-400 hover:bg-blue-500">Save</button>
                <a @click="$router.back()" class="ml-2 rounded text-red-400 py-2 px-4 bg-gray-200 hover:bg-gray-300">Cancel</a>
            </div>
        </form>
    </div>
</template>

<script>
    import InputField from './InputField'

    export default {
        name: 'EditContact',

        components: {InputField},

        data() {
            return {
                editForm: {
                    name: null,
                    email: null,
                    company: null,
                    birthday: null
                },
                errors: null
            }
        },

        created() {
            axios.get('/api/contacts/' + this.$route.params.id)
                .then(res => {
                    this.editForm = res.data.data;
                })
                .catch(errors => {
                    if(errors)
                    {
                        this.$router.push('/contacts');
                    }
                });
        },

        methods: {
            editContact() {
                axios.put('/api/contacts/' + this.$route.params.id, this.editForm)
                    .then(res => {
                        this.$router.push(res.data.links.self)
                    })
                    .catch(errors => console.log(this.errors = errors.response.data.errors));
            },
        }
    }
</script>

<style>

</style>