<template>
    <div class="mt-4">
        <file-pond
            id="image"
            name="image"
            :allowDrop="true"
            :dropOnPage="true"
            :dropOnElement="false"
            :allowReorder="true"
            ref="pond"
            class-name="my-pond"
            label-idle="Or upload files..."
            allow-multiple="true"
            accepted-file-types="image/jpeg, image/png"
            @init="filepondInitialized"
        />
    </div>

</template>


<script>
// computed & ref
import {computed, ref} from "vue";
// vueFilePond: import vueFilePond function
import vueFilePond, {setOptions} from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';


setOptions({
    server: {
        process: {
            url: './api/upload-product-images',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    }
});

// use the imported "vueFilePond" function
const FilePond = vueFilePond(FilePondPluginFileValidateType);
export default {
    components: {
        FilePond // breaks down to: file-pond
    },
    data() {
        return {}
    },

    methods: {
        filepondInitialized() {
            console.log('is ready')
            // grap filepond object
            console.log('Filepond object:', this.$refs.pond)
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
