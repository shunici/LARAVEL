<style>
	.marquee-parent {
  position: relative;
  width: 100%;
  overflow: hidden;
  height: 30px;
}
.marquee-child {
  display: block;
  width: 147px;
  /* width of your text div */
  height: 30px;
  /* height of your text div */
  position: absolute;
  animation: marquee 5s linear infinite; /* change 5s value to your desired speed */
}
.marquee-child:hover {
  animation-play-state: paused;
  cursor: pointer;
}
@keyframes marquee {
  0% {
    left: 50%;
  }
  100% {
    left: -147px /* same as your text width */
  }
}
</style>

    <div class="marquee-parent">
        <div class="marquee-child">
          Hover on me to stop
        </div>
      </div>
