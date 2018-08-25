<template>

	<div class="notice">{{msg}}</div>
</template>

<script>
	export default {
		props : ["msg"]
	}
</script>

<style>
	.notice{
	    position: fixed;
	    width: 200px;
	    height: 50px;
	    background: #e33f78;
	    left: 20px;
	    top: 40px;
	    font-size: 14px;
	    z-index: 5;
	    border-radius: 4px;
	    color: #fff;
	    display: flex;
	    justify-content: center;
	    align-items: center;
	    text-align: center;
	}
</style>