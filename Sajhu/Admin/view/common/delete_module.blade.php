<!-- Button trigger modal -->
<button type="button" class="btn btn-dark btn-xs" data-toggle="modal" data-target="#delete{{ $id }}">
    <i class="fa fa-trash-o"></i> Delete
</button>

<!-- Modal -->
<div class="modal fade" id="delete{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route(AppHelper::getBaseRoute('destroy'),$id) }}" method="post">
                @csrf @method('delete')
                <div class="modal-header" style="background-color: #4B5F71;color: #ffffff">
                    <h5 class="modal-title" id="exampleModalLongTitle"><b>Delete {{ AppHelper::getTitle() }}</b></h5>
                </div>
                <div class="modal-body">
                    Are You Sure you want to delete <b style="color: #4B5F71">{{ $title }}</b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btn-xs" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                    <button type="submit" class="btn btn-dark btn-xs"><i class="fa fa-trash"></i> Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
