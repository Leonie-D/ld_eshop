<div class="toast" style="position: absolute; top: 2rem; right: 2rem;" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
    <div class="toast-header bg-secondary text-white">
      <strong class="mr-auto">{{__(Session('title'))}}</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
        <p>{{__(Session('message'))}}</p>
    </div>
</div>