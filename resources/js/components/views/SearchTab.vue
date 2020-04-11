<template>
    <div>
        <div v-if="focus" @click="focus=false" class="bg-black absolute opacity-25 right-0 left-0 top-0 bottom-0 z-10"></div>
        
        <div class="relative z-10">
            <div class="absolute">
                <svg class="h-8 w-8 pt-2 pl-2 fill-current text-gray-700" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999;" xml:space="preserve">
                        <path d="M508.874,478.708L360.142,329.976c28.21-34.827,45.191-79.103,45.191-127.309c0-111.75-90.917-202.667-202.667-202.667
                            S0,90.917,0,202.667s90.917,202.667,202.667,202.667c48.206,0,92.482-16.982,127.309-45.191l148.732,148.732
                            c4.167,4.165,10.919,4.165,15.086,0l15.081-15.082C513.04,489.627,513.04,482.873,508.874,478.708z M202.667,362.667
                            c-88.229,0-160-71.771-160-160s71.771-160,160-160s160,71.771,160,160S290.896,362.667,202.667,362.667z"/>
                </svg>
            </div>
        
            <input type="text" placeholder="Search the contacts" id="searchTerm" v-model="contact" @input="searchContacts" @focus="focus=true" class="rounded-full w-64 border border-gray-400 pl-10 p-2 mr-3 focus:outline-none text-sm text-black focus:shadow focus:bg-gray-100 focus:border-blue-600">
        
            <div v-if="focus" class="absolute bg-blue-900 text-white rounded-lg- p-4 w-96 right-0 mr-6 mt-2 shadow z-20">
                <div v-if="searchResult == 0">No Result found for '{{contact}}'</div>
                
                <div v-for="result in searchResult" :key='result.id' @click="focus=false">
                    <router-link :to="result.links.self">
                        <div class="flex items-center">
                            <UserCircle :name="result.data.name" class="mr-3"/>
                            {{result.data.name}}
                        </div>
                    </router-link>
                </div>
            </div>
        
        </div>
        
    </div>
</template>

<script>
    import _ from 'lodash';
    import UserCircle from './UserCircle'

    export default {
        name: 'SearchTab',

        components: {UserCircle},

        data() {
            return {
                contact: '',
                searchResult: [],
                focus: false
            }
        },

        methods: {
            searchContacts: _.debounce(function (e) {
                if(this.contact.length < 2) {
                    return
                }

                axios.post('/api/search', {searchTerm: this.contact})
                    .then(res => {
                        this.searchResult = res.data.data;
                        console.log(this.searchResult);
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
            }, 500)
        }
    }
</script>

<style>

</style>