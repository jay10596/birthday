<template>
    <div class="w-full">
        <div v-if="loading">
            Loading...
        </div>

        <div v-else>
            <div class="flex items-center justify-between">
                <a href="#" class="text-blue-400" @click="$router.back()">
                    Back
                </a>

                <div class="relative">
                    <router-link :to="'/contacts/' + contact.id + '/edit'" class="px-4 py-2 border border-blue-400 text-blue-400 text-sm rounded">Edit</router-link>
                    <a class="px-4 py-2 border border-red-500 text-red-500 text-sm rounded" @click="model = ! model">Delete</a>

                    <div v-if="model" class="absolute bg-blue-900 rounded-lg text-white w-64 right-0 z-10 mt-2 p-3">
                        <p>Are you sure you want to delete this contact?</p>
                        
                        <div class="flex items-center justify-end mt-3">
                            <button @click="model=false" class="text-sm">Cancel</button>
                            <button @click="deleteContact" class="ml-6 px-4 py-2 bg-red-500 rounded text-sm">Delete</button>
                        </div>
                        
                    </div>
                </div>

                <div v-if="model" class="bg-black opacity-25 absolute z-0 left-0 top-0 right-0 bottom-0" @click="model=false"></div>

            </div>

            <div class="flex pt-8 flex items-center">
                <UserCircle v-if="contact.name" :name="contact.name[0]"/>

                <div class="pl-6">
                    {{contact.name}}
                </div>
            </div>

            <p class="pt-8 text-gray-600 uppercase text-sm font-bold">Email</p>
            <p class="pt-1 text-blue-600">{{contact.email}}</p>

            <p class="pt-8 text-gray-600 uppercase text-sm font-bold">Company</p>
            <p class="pt-1 text-blue-600">{{contact.company}}</p>

            <p class="pt-8 text-gray-600 uppercase text-sm font-bold">Birthday</p>
            <p class="pt-1 text-blue-600">{{contact.birthday}}</p>
        </div>
    </div>
</template>

<script>
    import UserCircle from './UserCircle'

    export default {
        name: 'DisplayContact',

        components: {UserCircle},

        data() {
            return {
                loading: true,
                model: false,
                contact: ''
            }
        },

        created() {
            axios.get('/api/contacts/' + this.$route.params.id)
                .then(res => {
                    this.contact = res.data.data;
                    //console.log(this.contact);
                    this.loading = false;
                })
                .catch(errors => {
                    this.loading = true;

                    if(errors)
                    {
                        this.$router.push('/contacts');
                    }
                });
        },

        methods: {
            deleteContact() {
                axios.delete('/api/contacts/' + this.$route.params.id)
                    .then(res => {
                        this.$router.push('/contacts');
                    })
                    .catch(errors => {
                        alert('Inrernal Error! Enable to delete the contact.')

                        if(errors.res.status === 404)
                        {
                            this.$router.push('/contacts');
                        }
                    });
            }
        }
    }
</script>

<style>

</style>