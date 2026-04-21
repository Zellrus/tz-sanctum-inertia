<template>
    <header>
    <div class="header-container">
        <nav class="desktop-nav">
            <Link class="nav-item" href="/" ><span>Catalog</span></Link>
            <Link class="nav-item" href="/" ><span>Admin</span></Link>
        </nav>
        <Link class="nav-item" href="/" ><span>Login</span></Link>
    </div>
    </header>
</template>
<script setup>

import {Link} from "@inertiajs/vue3";
</script>
<style scoped>
header{
    width: 100%;
    display: flex;
    background-color: var(--bg-color);
     border-bottom: 1px solid rgb(201, 199, 200);
    position: sticky;
    z-index: 10;
    top: 0;
     /*box-shadow: 0px 2px 2px 1px rgba(34, 60, 80, 0.2);*/
}
.header-container{
    display: grid;
    grid-template-columns: max-content  min-content;
    height: var( --header-height);
    align-items: center;
    margin: var(--global-margin);
    width: 100%;
    column-gap: 40px;
    justify-content: space-between;
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

.nav-item:hover{
    background-color: rgba(201, 199, 200, 0.288);
}
.nav-item:active{
    background-color: rgba(201, 199, 200, 0.662)
}

</style>
