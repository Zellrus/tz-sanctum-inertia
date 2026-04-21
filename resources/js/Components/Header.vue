<template>
    <div class="header-container">
        <nav class="desktop-nav">
            <Link class="nav-item" href="/" ><span>Catalog</span></Link>
            <Link class="nav-item" href="/" ><span>Admin</span></Link>
        </nav>
    </div>
</template>
<script setup>

import {Link} from "@inertiajs/vue3";
</script>
<style scoped>
.header-container{
    height: var( --header-height);
    align-items: center;
    margin: var(--global-margin);
    width: 100%;
    column-gap: 40px;
    display: flex;
}
.desktop-nav ul{
    display: flex;
    list-style-type: none;
    padding: 0;
    column-gap: 24px;
    align-items: center;
}
li{
    display: flex;
    align-items: center;
    width: auto;
    text-wrap-mode: nowrap;
}
.nav-item{
    color:currentColor;
    font-family: Inter, Inter Fallback, sans-serif;
    font-size: 16px;
    font-weight: 500;
    padding: 10px;
    /* border: 1px solid rgb(201, 199, 200); */
    border-radius: var(--btn-border-radius);
    cursor: pointer;
}

.nav-item:hover, .logo:hover, .language-dropdown:hover{
    background-color: rgba(201, 199, 200, 0.288);
}
.nav-item:active, .logo:active{
    background-color: rgba(201, 199, 200, 0.662)
}
</style>
