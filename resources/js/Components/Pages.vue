<template>
    <Navigation>
        <template v-slot:menu>
            <div>
              <span>
                <a href="#" @click="selectMenu('dashboard')">Dashboard</a>
              </span> |
              <span>
                <a href="#" @click="selectMenu('modules')">Modules</a>
              </span>
            </div>
        </template>
        <template v-slot:button v-if="selectedPage=='modules'">
            <button @click="modulesRef.generateFiles" class="button">
                GENERATE FILES
            </button>
        </template>
    </Navigation>

    <main class="main">
        <Dashboard v-if="selectedPage=='dashboard'" />
        <Modules v-if="selectedPage=='modules'" ref="modulesRef" />
    </main>
</template>

<script setup>
    import { ref } from 'vue';

    const modulesRef = ref();
    const selectedPage = ref('modules');

    function selectMenu(menuName) {
        selectedPage.value = menuName;
    }
</script>