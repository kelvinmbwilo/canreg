/**
 * Created by kelvin on 4/8/14.
 */
$(document).ready(function(){
    $("#chartarea").html("<i class='fa fa-spinner fa-spin fa-3x'></i> Loading... ")
    $("#chartarea").load("contraceptive/barchat/");

    $("#table").unbind("click").click(function(){
        $(".btn").removeClass("btn-info")
        $(this).addClass("btn-info")
        $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
        $("#formms").ajaxSubmit({
            target: '#chartarea',
            data: {chat:'table'},
            success:  afterSuccess
        });
    });

    $("#pie").unbind("click").click(function(){
        $(".btn").removeClass("btn-info")
        $(this).addClass("btn-info")
        $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
        $("#formms").ajaxSubmit({
            target: '#chartarea',
            data: {chat:'table'},
            success:  afterSuccess
        });
    });

    $("#bar").unbind("click").click(function(){
        $(".btn").removeClass("btn-info")
        $(this).addClass("btn-info")
        $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
        $("#formms").ajaxSubmit({
            target: '#chartarea',
            data: {chat:'table'},
            success:  afterSuccess
        });
    });

    $("#line").unbind("click").click(function(){
        $(".btn").removeClass("btn-info")
        $(this).addClass("btn-info")
        $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
        $("#formms").ajaxSubmit({
            target: '#chartarea',
            data: {chat:'table'},
            success:  afterSuccess
        });
    });
});

function afterSuccess(){

    }