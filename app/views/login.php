<div class="outer">
    <form action="/login" method="POST">

        <?php if($show_error){?>
        <div class="form-group alert alert-danger">
            <strong>Login failed</strong>
        </div>
        <?php } ?>

        <div class="form-group">
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" class="form-control" autofocus required/>
        </div>

        <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" class="form-control" required />
        </div>

        <div class="form-group">
            <input type="submit" class="btn" value="login"/>
        </div>

    </form>

</div>
