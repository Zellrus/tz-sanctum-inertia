<template>
    <div class="accordion-container">
        <button @click.prevent="togglePanel" :aria-expanded="showPanel.toString()">
            <slot name="head">
                <div class="accordion-wrapper">
                    <div :id="id_header" class="accordion">
                        <span class="header-title">{{headerTitle}}</span>
                        <Arrow :isRotate="showPanel" />
                    </div>
                </div>
            </slot>
        </button>
        <transition
            name="accordion"
            @enter="enter"
            @after-enter="afterEnter"
            @leave="leave"
        >
            <div
                v-show="showPanel"
                class="content"
                ref="panel"
            >
                <slot name="content"></slot>
            </div>
        </transition>
    </div>
</template>


<script>
import Arrow from "./Base/Arrow.vue";
export default {
    components: {Arrow},
    props: {
        headerTitle:String,
        showPanelProp:{
            type:Boolean,
            default: false,
        },
        id_header:String,
    },
    data() {
        return {
            showPanel: this.showPanelProp
        };
    },
    methods: {
        togglePanel() {
            this.showPanel = !this.showPanel;
            this.$emit("update:showPanel", this.showPanel);
        },
        enter(el) {
            el.style.height = '0';
            requestAnimationFrame(() => {
                el.style.height = el.scrollHeight + 'px';
            });
        },

        afterEnter(el) {
            el.style.height = 'auto';
        },

        leave(el) {
            el.style.height = el.scrollHeight + 'px';
            requestAnimationFrame(() => {
                el.style.height = '0';
            });
        }
    }
};
</script>
<style scoped>
button{
    all: unset;
    cursor: pointer;
    width: 100%;
}
.accordion-container{
    width:100%
}
.accordion-enter-active,
.accordion-leave-active {
    transition: height 0.3s ease;
    overflow: hidden;
}

.accordion-enter-from,
.accordion-leave-to {
    height: 0;
}

.accordion-wrapper {
    position: relative;
    display: inline-block;
    width: 100%;
    font-size: 16px;
    font-family: Inter, "Inter Fallback", sans-serif;
    font-feature-settings: normal;
    font-weight: 700
}

.accordion {
    display: flex;
    align-items: center;
    padding: 8px;
    /* background-color: #dddcd9; */
    border-radius: 20px;
    height: 100%;
    cursor: pointer;
    position: relative;
    justify-content: space-between;
}
.accordion:hover{
    background-color: rgba(201, 199, 200, 0.288);
}

.arrow {
    display: flex;
}

/* button[aria-expanded="true"] .item, button[aria-expanded="true"] .accordion{*/
/*  border-radius: 15px 15px 0 0;*/
/*  background-color: rgb(80, 84, 85);*/
/*} */
</style>
