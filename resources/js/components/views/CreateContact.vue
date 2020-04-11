<template>
    <div>
        <form @submit.prevent="createContact">
            <InputField name="name" label="Name" placeholder="Contact Name" :errors="errors" @updatingField="createForm.name = $event"/>
            <InputField name="email" label="Email" placeholder="Contact Email" :errors="errors" @updatingField="createForm.email = $event"/>
            <InputField name="company" label="Company" placeholder="Contact Company" :errors="errors" @updatingField="createForm.company = $event"/>
            <InputField name="birthday" label="Birthday" placeholder="mm/dd/yyyy" :errors="errors" @updatingField="createForm.birthday = $event"/>

            <div class="flex justify-end">
                <button class="rounded text-white py-2 px-4 bg-blue-400 hover:bg-blue-500">Save</button>
                <button class="ml-2 rounded text-red-400 py-2 px-4 bg-gray-200 hover:bg-gray-300">Cancel</button>
            </div>
        </form>
    </div>
</template>

<script>
    import InputField from './InputField'

    export default {
        name: 'CreateContact',

        components: {InputField},

        data() {
            return {
                createForm: {
                    name: null,
                    email: null,
                    company: null,
                    birthday: null
                },
                errors: null
            }
        },

        methods: {
            createContact() {
                axios.post('api/contacts', this.createForm)
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