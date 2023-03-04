<template>
    <div>
        <div class="root">
            <div class="container">
                <small class="text-center">Your website creation progress</small>
                <ul class="progressbar">
                    <li :class="{active: step.filled}"  v-for="(step, index) in steps" :key="index">
                        <small class="font-poppins">{{ step.stepValue }}</small>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            stepsValue: [
                
            ]
        }
    },
    props: {steps: Object},
    watch: {
        steps: {
            handler(newValue, oldValue) {
                console.log(newValue)
            },
            deep: true
        }
    }
}
</script>
<style scoped>
.font-poppins {
    font-family: 'Poppins', sans-serif;
}
@media screen and (max-width: 640px) {
    .progressbar li:before {
        width: 23px !important;
        height: 23px !important;
        line-height: 20px !important;
    }
    .progressbar li:after {
        top: 11.1555px !important;
    }
    ul {
        width: 100%;
        margin: 0;
    }
    .font-poppins {
        display: none;
    }
}
.container{
     /* width: 35%; */
    position: absolute;
    z-index: 1;
    margin-top: 20px;
    right: 50%;
    transform: translate(50%,-50%);
}
.progressbar{
  counter-reset: step;
}
.progressbar li{
  float: left;
  width: 10%;
  position: relative;
  text-align: center;
  list-style-type: none;
}
.progressbar li:before{
  content:counter(step);
  counter-increment: step;
  width: 30px;
  height: 30px;
  border: 2px solid #bebebe;
  display: block;
  margin: 0 auto 10px auto;
  border-radius: 50%;
  line-height: 27px;
  background: white;
  color: #bebebe;
  text-align: center;
  font-weight: bold;
}
.progressbar li:after{
  content: '';
  position: absolute;
  width:100%;
  height: 3px;
  background: #979797;
  top: 15px;
  left: -50%;
  z-index: -1;
}
.progressbar li.active:before{
 border-color: var(--primary);
 background: var(--primary);
 color: white
}
/* .progressbar li.active:after{
 background: var(--primary);
} */
.progressbar li.active + li:after{
 background: var(--primary);
 
}

.progressbar li.active + li.active:before{
 background: var(--primary);
 /* width: 100%; */
}

/* .progressbar li.active + li:before{
border-color: var(--primary);
background: var(--primary);
color: white;
} */
.progressbar li:first-child:after{
 content: none;
}
</style>