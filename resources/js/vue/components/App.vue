<template>
    <div v-if="isPending">
        Loading images...
    </div>
    <div v-if="error" class="my-12">
        <h1 class="primayHeader text-center">Error when loading images..</h1>
        <p class="primaryParagraph text-center text-red-500">{{ error }}</p>
    </div>
    <div class="block mb-20">
        <div class="mt-4">
            <file-pond
                id="image"
                name="image"
                :allowDrop="true"
                :dropOnPage="false"
                :dropOnElement="true"
                :allowReorder="true"
                ref="pond"
                class-name="my-pond"
                label-idle="Or upload files..."
                allow-multiple="true"
                accepted-file-types="image/jpg, image/jpeg, image/png"
                max-file-size="1MB"
                @init="filepondInitialized"
                @processfile="handleProcessedFile"
            />
        </div>
    </div>


    <div class="mt-12">
        <h3 class="text-3xl text-center">Image gallary</h3>
        <div class="grid grid-cols-3 gap-2 justify-evenly">
            <div v-for="(image, index) in images" :key="index">
                <img :src="'storage/images/' + image.name"
                     class="block object-cover object-center w-full h-full rounded-lg">
            </div>
        </div>
    </div>


</template>


<script>
// computed & ref
import {computed, ref} from "vue";
// vueFilePond: import vueFilePond function
import vueFilePond, {setOptions} from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import {useAjax} from "../composables/use-ajax";

// handle custom backend error
let serverMessage = {};

setOptions({
    server: {
        process: {
            url: './upload-product-images',
            onerror: (response) => {
                console.log('is: ', response)
                if (response) {
                    console.log('øøøøøøø ja: ', response)
                    serverMessage = JSON.parse(response);
                }
            },
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    },
    labelFileProcessingError: () => {
        return serverMessage.error
    },
});

// use the imported "vueFilePond" function
const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginFileValidateSize);
const {loadData, isPending, error} = useAjax()

export default {
    components: {
        FilePond // breaks down to: file-pond
    },
    data() {
        return {
            images: [],
            loadData,
            isPending,
            error
        }
    },

    // get images
    async mounted() {
        // load images for frontend
        // try
        try {
            const data = await loadData(
                `/images`,
                {},
                {additionalCallTime: 500, pending: true}
            )

            this.images = data;
            // catch errors
        } catch (err) {
            console.log('Error message:', err)
        }
    },


    methods: {
        filepondInitialized() {
            console.log('is ready')
            // grap filepond object
            console.log('Filepond object:', this.$refs.pond)
        },
        handleProcessedFile(error, file) {
            if (error) {
                console.log('Error for added image', error)
                return;
            }
            // add the file to our images array
            const dataImages = JSON.parse(file.serverId);
            console.log('errr: ', dataImages)
            this.images.push(dataImages);
        }
    },
}
</script>


<style>
.filepond--drop-label {
    background: #eee;
    border-radius: 6px;
}

.filepond--credits {
    display: none;
}
</style>
