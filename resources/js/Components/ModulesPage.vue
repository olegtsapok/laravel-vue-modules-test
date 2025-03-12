<template>
      <section class="pane available-modules-pane">
        <h3>AVAILABLE MODULES</h3>
        <button @click="selectModule" name="BgModule" class="available-modules-pane__button button">
          BACKGROUND
        </button>
        <button @click="selectModule" name="TypoModule" class="available-modules-pane__button button">
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
            <KeepAlive>
                <BgModule v-if="selectedModule=='BgModule'" />
            </KeepAlive>
            <KeepAlive>
                <TypoModule v-if="selectedModule=='TypoModule'" />
            </KeepAlive>
      </section>
</template>

<script setup>
    import TypoModule from '../Components/Modules/TypoModule.vue'
    import BgModule from '../Components/Modules/BgModule.vue'

    import { ref } from 'vue';
    import { forceFileDownload, hadleResponseError } from '../utils.js'

    
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

        if (selectedModule.value == 'TypoModule') {
            alert(`Generating files for module ${selectedModuleTitle.value} is not implemented`);
            return;
        }

        //alert('Done'); return;
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

    // add function for using in parent refs
    defineExpose({ generateFiles })
</script>

