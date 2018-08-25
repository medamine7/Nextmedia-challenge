<template>
	<div>
		<transition
	    name="custom-classes-transition"
	    enter-active-class="animated fadeInLeft"
	    leave-active-class="animated fadeOutLeft">
			<notice :msg="message" v-if="notice"></notice>
		</transition>
		<img v-show="loading" id="preloader" src="/img/preloader.svg" alt="">	
		<transition-group
		    name="custom-classes-transition"
		    enter-active-class="animated fadeInUp"
		    leave-active-class="animated bounceOut"
		    class="container cards-container"
		    tag="div">
		  	<div :key="shop._id" v-for="(shop,index) in shops" class="card animated fadeInUp">
		        <div class="card-header">
		            {{shop.name}}
		        </div>
		        <div class="card-image">
		            <img :src="shop.picture" alt="">
		        </div>
		        <div class="card-footer">
		            <button @click="dislikeShop(shop._id,index);"><i class="far fa-thumbs-down"></i> DISLIKE</button>
		            <button @click="likeShop(shop._id,index)"><i class="far fa-thumbs-up"></i> LIKE</button>
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
				message : '',
				loading: true,
				notice: false
			}
		},
		components : {
			notice,
		},
		created(){
			var _this = this;
			axios.get('/getnearbyshops')
			.then(response=>{
				_this.loading=false;
				_this.shops=response.data.shops;
			})
			.catch();
		},

		methods: {
	    	likeShop(id,index){
	    		var _this=this;
    			_this.shops.splice(index, 1);
	    		axios.post('/shop/like/'+id)
	    		.then(response=>{
	    			_this.message="Added to your preferred shops.";
	    			_this.showNotice();
	    		})
	    		.catch();
	    	},


	    	dislikeShop(id,index){
	    		var _this=this;	
    			_this.shops.splice(index, 1);
	    		axios.post('/shop/dislike/'+id)
	    		.then(response=>{
	    			_this.message="Disliked.";
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