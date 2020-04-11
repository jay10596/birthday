<template>
    <div class="h-screen bg-white">
        <div class="flex">
            <Toolbar/>

            <div class="flex flex-col flex-1 h-screen">
                <SearchBar :name="user.name" :title="title"/>

                <div class="flex overflow-y-hidden">
                    <router-view  :user="user" class="p-6 overflow-x-hidden"></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Toolbar from './Toolbar'
    import SearchBar from './SearchBar'

    export default {
        name: "App",

        props: [
            'user'
        ],

        data() {
            return {
                title: ''
            }
        },

        watch: {
            $route(to, from) {
                this.title = to.meta.title;
            },

            title() {
                document.title = this.title + ' | BirthdaySPA'
            }
        },

        created() {
            this.title = this.$route.meta.title;

            window.axios.interceptors.request.use(
                (config) => {
                    if(config.method === 'get') {
                        config.url = config.url + '?api_token=' + this.user.api_token;
                    }
                    else {
                        config.data = {
                            ...config.data,
                            api_token: this.user.api_token  
                        };
                    }
                    
                    return config;
                }
            )
        },

        components: {Toolbar, SearchBar}
    }
</script>
