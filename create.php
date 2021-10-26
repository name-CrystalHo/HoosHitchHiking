<?php include("base.php")?>
    <!--Create Post form-->
    <h1 class = "display-4" style = "text-align: center; margin-top: 4vh; margin-bottom: 4vh;">
        Create a Post
    </h1>
    <div class = "row" style = "text-align: center; margin-left: 50%; margin-right: 50%;">
    <div class="btn-group btn-group-toggle" data-toggle="buttons" style = "justify-content: center;">
        <label class="btn btn-secondary active">
            <input type="radio" name="options" id="option1" autocomplete="off" checked> Request
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" id="option2" autocomplete="off"> Offer
        </label>
    </div>
    </div>

    <div class = "container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-6">
                <form>
                    <div class="form-group">
                    <label for="address">Destination</label>
                    <input type="email" class="form-control" id="email" name = "email" aria-describedby="emailHelp" placeholder="Enter event name">
                    </div>
                    <div class="form-group">
                        <label for="meeting-time">Date and Time of Departure</label>
                        <input type="datetime-local" class = "form-control" id="meeting-time" name="meeting-time" name="meeting-time">
                    </div>
                    <div class="form-group">
                        <label for="event-description">Description</label>
                        <textarea class="form-control" id="description" name = "description" rows="7"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" style = "margin-top: 2vh;"><a href="index.html">Create</a></button>
                </form>
            </div>
        </div>
    </div>

<?php include("footer.php")?>