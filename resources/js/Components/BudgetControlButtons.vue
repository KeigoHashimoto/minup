<template>
<div>
    <div class="buttons">
        <div @click="toggle('share')" >
            <i class="fas fa-share share-btn"></i>
        </div>
        <div @click="toggle('fixedCost')">
            <i class="fas fa-bookmark fixed-cost-btn"></i>
        </div>
        <div>
            <a :href="this.editUrl" class="budget-edit-btn"><i class="fas fa-edit"></i></a>
        </div>
    </div>
    <fixed-cost-drop-down
      v-if="fixedCostFlag"
      :budget_id="budget_id" 
    >
    </fixed-cost-drop-down>
    <div v-if="share_exists != null">
        <share-component
            v-if="shareFlag"
            :budget_id="budget_id"
        >
        </share-component>
    </div>

</div>
</template>

<script>
import FixedCostDropDown from './FixedCostDropDown.vue';
import ShareComponent from './ShareComponent.vue';
import { ref } from 'vue';
export default{
  components: {
    FixedCostDropDown,
    ShareComponent
  },

  props: {
    budget_id: {
        type: Number,
        require: true
    },
    share_exists: {
        type: Object,
        require: true
    }
  },

  data() {
    return {
        shareFlag: ref(false),
        fixedCostFlag: ref(false),
        editUrl: ref(''),
    }
  },

  methods: {
    toggle(text){
        if (text == 'share') {
            this.shareFlag= !this.shareFlag;
            if(this.fixedCostFlag) {
                this.fixedCostFlag = false;
            }
        } else if (text == 'fixedCost') {
            this.fixedCostFlag = !this.fixedCostFlag;
            if(this.shareFlag) {
                this.shareFlag = false;
            }
        }
    }
  },
  mounted() {
    this.editUrl = `/budget/${this.budget_id}/edit`;
  }
}

</script>

<style scoped>
.buttons {
    display: flex;
    gap:1.5rem;
    font-size:20px;
    width: fit-content;
    margin: 1rem auto;
}
</style>
