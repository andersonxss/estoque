<template>
    <div class="login">
        <router-view></router-view>
    </div>
</template>

<style>
.login {
    background: #272727;
    width: 100%;
    height: 100vh;
    position: absolute;
    z-index: 1000;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login form {
    width: 30%;
    min-width: 300px;
    height: 400px;
    background: white;
}
</style>
