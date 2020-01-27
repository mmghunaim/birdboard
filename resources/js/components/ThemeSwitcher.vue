<template>
    <div class="flex items-center">
        <button class="rounded-full w-5 h-5 bg-default border mr-2" @click="selectedTheme = 'theme-light'">
                
        </button>
        <button class="rounded-full w-5 h-5 bg-default border mr-2" @click="selectedTheme = 'theme-dark'"></button>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                selectedTheme: 'theme-light'
            };
        }
    }
</script>
