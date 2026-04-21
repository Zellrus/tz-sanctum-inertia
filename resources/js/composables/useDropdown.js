import {ref, onMounted, onBeforeUnmount} from 'vue'

export function useDropdown() {
    const isOpen = ref(false)
    const selectWrapper = ref(null)
    function toggleDropdown() {
        isOpen.value = !isOpen.value
        if (isOpen.value) {
            document.addEventListener('click', handleClickOutside)
        }
    }
    function closeDropdown() {
        isOpen.value = false
        document.removeEventListener('click', handleClickOutside)
    }

    function handleClickOutside(event) {
        if (selectWrapper.value && !selectWrapper.value.contains(event.target) ) closeDropdown()
    }

    function enter(el) {
        el.style.height = '0'
        el.style.opacity = '0'

        requestAnimationFrame(() => {
            el.style.transition = 'height 0.15s ease, opacity 0.15s ease'
            el.style.height = el.scrollHeight + 'px'
            el.style.opacity = '1'
        })
    }

    function afterEnter(el) {
        el.style.height = 'auto'
    }

    function leave(el) {
        el.style.height = el.scrollHeight + 'px'
        el.style.opacity = '1'

        requestAnimationFrame(() => {
            el.style.transition = 'height 0.15s ease, opacity 0.15s ease'
            el.style.height = '0'
            el.style.opacity = '0'
        })
    }


    onBeforeUnmount(() => {
        document.removeEventListener('click', handleClickOutside)
    })

    return {
        isOpen,
        selectWrapper,
        toggleDropdown,
        closeDropdown,
        handleClickOutside,
        enter,
        afterEnter,
        leave,
    }
}
