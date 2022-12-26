<div class="container mt-2">

    Marks: <input type="text" name="marks"
                  id="marks"><br><br>

    <!-- Button to invoke the modal -->
    <button type="button" class="btn btn-primary
            btn-sm" data-bs-toggle="modal"
            data-bs-target="#exampleModal"
            id="submit">
        Submit
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal"
         tabindex="-1"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLabel">
                        Confirmation
                    </h5>

                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">
                                ×
                            </span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Data passed is displayed
                        in this part of the
                        modal body -->
                    <h6 id="modal_body"></h6>
                    <button type="button"
                            class="btn btn-success btn-sm"
                            data-toggle="modal"
                            data-target="#exampleModal"
                            id="submit">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#submit").click(function () {
        var name = $("#name").val();
        var str = "You Have Entered "
            + "Name: " + name
            + " and Marks: " + marks;
        $("#modal_body").html(str);
    });
</script>