<template>
    <div class="mt-4">
        <file-pond
            name="image"
            ref="pond"
            allow-multiple="true"
            max-files="3"
            label-idle="Click to choose image, or drag here..."
            server="/upload"
            @init="filepondInitialized"
        />
    </div>

</template>


<script>
// Import FilePond
// vueFilePond: we are importing a function
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';

// We will use the imported "vueFilePond" function
const FilePond = vueFilePond();


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
    }
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
