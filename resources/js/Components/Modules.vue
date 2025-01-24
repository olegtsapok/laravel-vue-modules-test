<script setup>
    import { ref } from 'vue';
    import { forceFileDownload } from '../utils.js'
    
    const selectedModule = ref('');
    const selectedModuleTitle = ref('');
    const classSelectedModule = ref('hidden selected-module-pane__module ');
    const color = ref('#ff0000');

    /**
     * Click event to select module
     **/
    function selectModule(event)
    {
        selectedModuleTitle.value = event.target.innerText;
        selectedModule.value = event.target.name;
        classSelectedModule.value = 'selected-module-pane__module';
    }

    /**
     * Click event to generate files
     **/
    function generateFiles()
    {
        if (!selectedModule.value) {
            alert(`Please select module`);
            return;
        }

        if (selectedModule.value == 'typo') {
            alert(`Generating files for module ${selectedModuleTitle.value} is not implemented`);
            return;
        }

        saveAndDownload();
    }

    /**
     * Save module settings and download zip file
     **/
    function saveAndDownload() {
        axios.post('/api/modules', getRequestData())
        .then(function (response) {
          // handle success
          downloadModule(response.data.data.module_id);
        })
        .catch(function (error) {
          hadleResponseError(error);
        });
    }

    /**
     * Get request data to save module
     **/
    function getRequestData() {
        let data = {
            'url': document.getElementById('clickout').value,
            'width': document.getElementById('width').value,
            'height': document.getElementById('height').value,
            'color': document.getElementById('color').value,
        };

        return data;
    }

    /**
     * Download module as zip file
     **/
    function downloadModule(moduleId) {
        axios.get(`/api/modules/${moduleId}/download`, {responseType: 'blob'})
        .then(function (response) {
          // handle success
          forceFileDownload(response.data, 'module.zip');
        })
        .catch(function (error) {
          hadleResponseError(error);
        });
    }

    /**
     * Handle api error response
     **/
    function hadleResponseError(error) {
        let message = null;
        if (error.response.data.message) {
            message = error.response.data.message;
        } else if (error.message) {
            message = error.message;
        }

        if (!message) {
            message = 'Error during API request';
        }

        alert(message);
        console.log(message);
    }
</script>

<template>
    <nav class="nav">
      <img src="/logo.svg" alt="logo" />
      <button @click="generateFiles" class="button">GENERATE FILES</button>
    </nav>

    <main class="main">
      <section class="pane available-modules-pane">
        <h3>AVAILABLE MODULES</h3>
        <button @click="selectModule" name="background" class="available-modules-pane__button button">
          BACKGROUND
        </button>
        <button @click="selectModule" name="typo" class="available-modules-pane__button button">
          TYPO
        </button>
      </section>

      <section class="pane selected-module-pane">
        <h3>SELECTED MODULE</h3>
        <div :class="classSelectedModule">
          <span>{{ selectedModuleTitle }}</span>
        </div>
      </section>

      <section class="pane module-settings-pane">
        <h3>MODULE SETTINGS</h3>

            <BgModule v-if="selectedModule=='background'" />
            <TypoModule v-if="selectedModule=='typo'" />

      </section>
    </main>
</template>