<template>
    <div class="w-full">
        <div v-if="loading">
            Loading...
        </div>

        <div v-else>
            <div v-if="contacts.length === 0">
                <router-link to='/create' class="flex items-center m-2">
                    <p>Contacts do not exist. Create one.                </p>
                </router-link>
            </div>

            <div v-for="contact in contacts" :key="contact.id">
                <div >
                    <router-link :to="'/contacts/' + contact.data.id" class="flex pt-8 flex items-center border-b border-gray-400 p-4 hover:bg-blue-100" >
                        <UserCircle v-if="contact.data.name" :name="contact.data.name[0]"/>

                        <div class="pl-6">
                            <p class="text-blue-600 font-bold">{{contact.data.name}}</p>
                            <p class=" text-sm">{{contact.data.company}}</p>
                        </div>
                    </router-link>
                </div> 
            </div>
        </div>
    </div>
</template>

<script>
    import UserCircle from './UserCircle'

    export default {
        name: 'ContactsList',

        components: {UserCircle},

        props: [
            'endpoint'
        ],

        data() {
            return {
                loading: true,
                model: false,
                contacts: ''
            }
        },

        created() {
            axios.get(this.endpoint)
                .then(res => {
                    this.contacts = res.data.data;
                    this.loading = false;
                    console.log(res)
                })
                .catch(errors => {
                    this.loading = true;
                    alert('Unabel to fetch contacts')
                });
        },

    }
</script>

<style>

</style>