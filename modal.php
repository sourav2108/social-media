<!-- comment modal -->
<div class="modal fade" id="cmtmodal" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header mx-1 border-bottom border-primary">
                <h5 class="modal-title" style='text-transform: capitalize;' >add comment</h5>
                <button type="button" style="background-color: red;" class="btn-close cmtcl" data-dismiss="modal" aria-label="close">X</button>
            </div>
            <div class="modal-body" id="cmtshow">
                 <input type="hidden" name="pid" id="pid">
                 
                 <textarea name="cmt" id="cmt" rows="3" cols="60" style="resize:none;" class="from-control"></textarea>
                 
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-primary cmtpost">Post</button>
            </div>
        </div>
    </div>
</div>

<!-- for show comment modal-->
<div class="modal fade" id="scmt" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header mx-1 border-bottom border-primary">
                <h5 class="modal-title" style='text-transform: capitalize;' >comments</h5>
                <button type="button" style="background-color: red;" class="btn-close" data-dismiss="modal" aria-label="close">X</button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled" id="cmtdetails">

                </ul>
                 
            </div>
        </div>
    </div>
</div>
<!-- show like modal -->
<div class="modal fade" id="showlike" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header mx-1 border-bottom border-primary">
                <h5 class="modal-title" style='text-transform: capitalize;' >Likes</h5>
                <button type="button" style="background-color: red;" class="btn-close" data-dismiss="modal" aria-label="close">X</button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled" id="likedetails">

                </ul>
                 
            </div>
        </div>
    </div>
</div>