<template>
	<div class="shops-list-container">
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
		  	<div :key="shop._id" v-for="(shop,index) in visibleShops" class="card animated fadeInUp">
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
	    <div v-show="!loading">
	    	<button class="load-more-btn" @click="loadMoreShops">Load more</button>
	    </div>
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
				notice: false,
				visibleShops: [],
				lastIndex :16
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
				_this.visibleShops=response.data.shops.slice(0,_this.lastIndex);
			})
			.catch();
		},

		methods: {
	    	likeShop(id,index){
	    		var _this=this;
    			_this.visibleShops.splice(index, 1);
	    		axios.post('/shop/like/'+id)
	    		.then(response=>{
	    			_this.message="Added to your preferred shops.";
	    			_this.showNotice();
	    		})
	    		.catch();
	    	},


	    	dislikeShop(id,index){
	    		var _this=this;	
    			_this.visibleShops.splice(index, 1);
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
	    	},

	    	loadMoreShops(){
	    		this.visibleShops= this.visibleShops.concat(this.shops.slice(this.lastIndex,this.lastIndex+16));
	    		this.lastIndex+=16;
	    	}


	    }
	}
</script>

<style>
	.load-more-btn{
	    border: none;
	    border-radius: 25px;
	    font-family: roboto;
	    font-weight: bold;
	    cursor: pointer;
	    background-image: linear-gradient(120deg, #ee5354 0%, #da2f93 100%);
	    color: #fff;
	    font-size: 20px;
	    display: block;
	    padding: 10px 20px;
	    margin: auto;
	}


	.shops-list-container{
	    margin-bottom: 80px;
	}
</style>