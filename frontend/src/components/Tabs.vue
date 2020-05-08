<template>
  <md-card
    class="md-card-tabs"
    :class="[
      { 'flex-column': flexColumn },
      { 'nav-pills-icons': navPillsIcons },
      { 'md-card-plain': plain }
    ]"
  >
    <md-card-header slot="header-title"> </md-card-header>

    <md-card-content>
      <md-list class="nav-tabs">
        <md-list-item
          v-for="(item, index) in tabName"
          @click="switchPanel(tabName[index])"
          :key="item"
          :class="[
            { active: isActivePanel(tabName[index]) },
            { [getColorButton(colorButton)]: isActivePanel(tabName[index]) }
          ]"
        >
          {{ tabName[index] }}
          <md-icon v-if="navPillsIcons">{{ tabIcon[index] }}</md-icon>
        </md-list-item>
      </md-list>

      <transition name="fade" mode="out-in">
        <div class="tab-content">
          <div
            :class="getTabContent(item.index + 1)"
            v-for="item in activePanelFilter"
            :key="item.index"
          >
            <slot :name="getTabContent(item.index + 1)">
              This is the default text!
            </slot>
          </div>
        </div>
      </transition>
    </md-card-content>
  </md-card>
</template>

<script>
export default {
  props: {
    flexColumn: Boolean,
    navPillsIcons: Boolean,
    plain: Boolean,
    tabName: Array,
    tabIcon: Array,
    colorButton: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      activePanel: this.tabName[0]
    };
  },
  methods: {
    switchPanel(panel) {
      this.activePanel = panel;
    },
    isActivePanel(panel) {
      return this.activePanel == panel;
    },
    getColorButton: function(colorButton) {
      return "md-" + colorButton + "";
    },
    getTabContent: function(index) {
      return "tab-pane-" + index + "";
    }
  },
  computed: {
    activePanelFilter: function() {
      let element = this.tabName.filter(tab => this.activePanel == tab)[0];
      let index = this.tabName.findIndex(item => element == item);
      return [{"element": element, "index": index}]
    }
  }
};
</script>

<style lang="css"></style>
