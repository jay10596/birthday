<template>
    <div class="">
        <div v-if="!hasImage">
            <input type="file" name='image' @change="getImage">
        
            <img :src="uploadedImage" alt="profilePic">

            <a href="#" @click.prevent="upload">Upload</a>
        </div>
        
        <!-- Design -->
        <div v-else class="max-w-sm rounded overflow-hidden shadow-lg">
            <img class="w-full" :src="uploadedImage" alt="Profile Pic">
            
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Welcome {{user.name}}</div>
                <p class="text-gray-700 text-base">
                This is an amazing Contact Birthday SPA
                </p>
            </div>

            <div class="px-6 py-4">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{user.name}}</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ExampleComponent",

        props: [
            'user'
        ],

        data() {
            return {
                uploadedImage: this.user.avatar,
                hasImage: false
            }
        },

        methods: {
            getImage(e) {
                let image = e.target.files[0]
                let reader = new FileReader()

                reader.readAsDataURL(image)
                reader.onload = e => {
                    this.uploadedImage = e.target.result
                }

            },

            upload() {
                axios.post('/upload', {'image': this.uploadedImage})
                    .then(this.hasImage = true)
                    .catch()
                
            }
        }
    }
</script>
