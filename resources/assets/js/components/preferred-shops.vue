<template>
	<div>
		<transition
	    name="custom-classes-transition"
	    enter-active-class="animated fadeInLeft"
	    leave-active-class="animated fadeOutLeft">
			<notice :msg="message" v-if="notice"></notice>
		</transition>
		<img v-show="loading" id="preloader" src="/img/preloader.svg" alt="">
	    <h3 id="shops-placeholder" v-if="!loading && shops.length==0">You don't have any preferred shops :/</h3>
	    <transition-group
	    name="custom-classes-transition"
	    enter-active-class="animated fadeInUp"
	    leave-active-class="animated bounceOut"
	    class="container cards-container"
	    tag="div">
	        <div class="card" v-for="(shop,index) in shops" :key="shop._id">
	            <div class="card-header">
	                {{shop.name}}
	            </div>
	            <div class="card-image">
	                <img :src="shop.picture" alt="">
	            </div>
	            <div class="card-footer">
	                <button @click="unlikeShop(shop._id,index)"><i class="far fa-trash-alt"></i> REMOVE</button>
	            </div>
	        </div>
	    </transition-group>
	</div>
</template>



<script>
	import notice from './notice';
	export default {
		data(){
			return {
				shops : [],
				loading: true,
				notice: false
			}
		},
		components : {
					notice,
		},
		created(){
			var _this = this;
			axios.get('/getpreferredshops')
			.then(response=>{
				_this.loading=false;
				_this.shops=response.data.shops;
			})
			.catch();

		},
		methods : {
	    	unlikeShop(id,index){	
				var _this = this;
    			_this.shops.splice(index, 1);
	    		axios.post('/shop/unlike/'+id)
	    		.then(response=>{
	    			_this.message="Removed from your preferred shops.";
	    			_this.showNotice();
	    		})
	    		.catch();
	    	},
	    	showNotice(){
	    		this.notice=true;

	    		setTimeout(()=>{
	    			this.notice=false;
	    		},3000);
	    	}
		}
	}
</script>

<style>
	#shops-placeholder{
	    color: #9c99b1;
	    text-align: center;
	    padding: 20px;
	    border: 2px solid #9c99b1;
	    margin: auto;
	    max-width: 300px;
    	margin-top: 30vh;
	    position: absolute;
    	left: 0;
    	right: 0;
	}
</style>