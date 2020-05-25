$("document").ready(function (e) {
    $("#load").hide();

    $(".form-client").on('submit', (function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/client.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if(data.trim()=="ok"){
                    $(".message").html("<div class='alert alert-success'>Fait avec success</div>")
                    alert("fait avec success");
                    location.reload(true);
                }else{
                    $('.message').html("<div class='alert alert-warning'>"+data+"</div> ");
                }
                $("#load").hide();
            }
        });
    }));


















    $(".service_employer").on("change", function () {
        $("#load").show();
        var service = $(".service_employer").val();
        var data = {
            "id_service": service
        };

        $.ajax({
            type: 'POST',
            url: 'app/DefaultApp/traitements/liste_role.php',
            data: data,
            success: function (reponse) {
                $(".ccc").empty();
                $(".ccc").append(reponse);
                $("#load").hide();
            }
        });
    });

    $("#form_enregistrer_employer").on('submit', (function (e) {
        e.preventDefault()
        $("#load").show();

        $data = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'app/DefaultApp/traitements/ajouter_employer.php',
            data: $data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (reponse) {
                if (reponse.trim() == "ok") {
                    $('.message').html('<div class="alert alert-success">Fait avec success</div>');
                    alert("fait avec success");
                    history.back();
                } else {
                    $('.message').html('<div class="alert alert-warning">' + reponse + '</div>');
                }
            }

        });
        $("#load").hide();
    }));

    $(".nom").on("change", function () {
        $("#load").show();
        var nombre=Math.floor(Math.random() * Math.floor(100));
        var nom=$(".nom").val();
        var prenom=$(".prenom").val();
        prenom=prenom.charAt(0);
        var identifiant=prenom+nom+nombre;
        $(".identifiant").val(identifiant);
        $("#load").hide();

    });

    $(".prenom").on("change", function () {
        $("#load").show();
        var nombre=Math.floor(Math.random() * Math.floor(100));
        var nom=$(".nom").val();
        var prenom=$(".prenom").val();
        prenom=prenom.charAt(0);
        var identifiant=prenom+nom+nombre;
        $(".identifiant").val(identifiant);
        $("#load").hide();
    });

    $(".f_amp").on('submit', (function (e) {
        $("#ajax-loading").show();
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/ajout_document.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $(".t_document").empty();
                $(".t_document").append(data);
                $("#ajax-loading").hide();
            }
        });
    }));

    $(".bte_sup").on("click", function () {
        $("#ajax-loading").show();
        var id = $(this).data("id");
        var id_employer = $(this).data("id_employer");
        $.ajax({
            url: "app/DefaultApp/traitements/ajout_document.php?supprimer_document&id=" + id + "&id_employer=" + id_employer + "&supe",
            type: "POST",
            data: "",
            contentType: false,
            cache: false,
            processData: false,
            success: function (datas) {
                $(".t_document").empty();
                $(".t_document").append(datas);
                $("#ajax-loading").hide();
            }
        });
    });

    $(".categorie").on("change",function () {
        var categorie=$(".categorie").val();
        if(categorie==="medecin"){
            $(".specialite").css("display","inline")
            $(".specialite1").css("display","none")
        }

        if(categorie==="autre"){
            $(".specialite1").css("display","inline")
            $(".specialite").css("display","none")
        }

    })

    $(".formulaire_ajouter_medcin").on('submit', (function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/medecin.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if(data.trim()=="ok"){
                    $(".message").html("<div class='alert alert-success'>Fait avec success</div>")
                    alert("fait avec success");
                    location.reload(true);
                }else{
                    $('.message').html("<div class='alert alert-warning'>"+data+"</div> ");
                }

                $("#load").hide();
            }
        });
    }));

    $(".f_ajout_document_pm").on('submit', (function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/medecin.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $(".t_document").empty();
                $(".t_document").append(data);
                $("#load").hide();
            }
        });
    }));

    $(".supdp").on("click", function () {
        $("#load").show();
        var id = $(this).data("id");
        var id_pm = $(this).data("id_pm");
        $.ajax({
            url: "app/DefaultApp/traitements/medecin.php?supprimer_document&id=" + id + "&id_pm=" + id_pm+ "&supe",
            type: "POST",
            data: "",
            contentType: false,
            cache: false,
            processData: false,
            success: function (datas) {
                $(".t_document").empty();
                $(".t_document").append(datas);
                $("#load").hide();
            }
        });
    });

    $(".btn_pr").on("click", function () {

        var data = "<div class='div1'><div class='row'><div class='form-group col-md-3'><label>Nom</label><input type='text' name='nomp[]' placeholder='Nom' class='form-control' required> </div>" +

            "<div class='form-group col-md-3'><label>Poste</label><input type='text' name='postep[]' placeholder='Poste' class='form-control' required> </div>" +

            "<div class='form-group col-md-3'><label>Téléphone</label> <input type='text' name='telephonep[]' placeholder='Telephone' class='form-control telephone' required> </div>" +

            "<div class='form-group col-md-3'><label>Email</label> <input type='text' name='emailp[]' placeholder='Email' class='form-control' required> </div></div></div>";

        $(".div_pr").append(data);
    });

    $(".btn_pr_moins").on("click", function () {
        $('.div_pr .div1').last().remove();
    });


    $(".formulaire_ajouter_laboratoire").on('submit', (function (e) {
        $('#load').show();
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/laboratoire.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    $(".message").html("<div class='alert alert-success'>Enregistrer avec success...</div>");
                    alert("Enregistrer avec success...");
                    document.location.href = 'ajouter-laboratoire';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }
                $('#load').hide();
            }
        });
    }));

    $("#forme_demande_laboratoire").on('submit', (function (e) {
        e.preventDefault();
        $('#load').show();
        $.ajax({
            url: "app/DefaultApp/traitements/laboratoire.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataTpe: "json",
            success: function (data) {
                if (data.trim() == "ok") {
                    $(".message").html("<div class='alert alert-success'>Fait avec success</div>");
                    alert("Fait avec success");
                    history.back();
                } else {
                    $(".message").html("<div class='alert alert-success'>" + data.trim() + "</div>");

                }
                $('#load').hide();
            }
        });

    }));

    $("#forme_demande_imagerie").on('submit', (function (e) {
        e.preventDefault();
        $('#load').show();
        $.ajax({
            url: "app/DefaultApp/traitements/imagerie.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataTpe: "json",
            success: function (data) {
                if (data.trim() == "ok") {
                    $(".message").html("<div class='alert alert-success'>Fait avec success</div>");
                    alert("Fait avec success");
                    history.back();
                } else {
                    $(".message").html("<div class='alert alert-success'>" + data.trim() + "</div>");

                }
                $('#load').hide();
            }
        });

    }));

    $(".fait_laboratoire").on('submit', (function (e) {
        e.preventDefault();
        $('#load').show();
        $.ajax({
            url: "app/DefaultApp/traitements/laboratoire.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataTpe: "json",
            success: function (data) {
                $(".message").html("<div class='alert alert-success'>" + data.trim() + "</div>");
                $('#load').hide();
            }

        });
    }));

    $(".fait_imagerie").on('submit', (function (e) {
        e.preventDefault();
        $('#load').show();
        $.ajax({
            url: "app/DefaultApp/traitements/imagerie.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataTpe: "json",
            success: function (data) {
                if(data.trim()=="ok"){
                    $(".message").html("<div class='alert alert-success'>Fait avec success</div>");
                    alert("fait avec success");
                    location.reload(true);
                }else{
                    $(".message").html("<div class='alert alert-success'>" + data.trim() + "</div>");
                }
                $('#load').hide();
            }

        });
    }));

    $(".categorie_ex").on("change",function () {
        var type=$(".categorie_ex").val();
        if(type == 'frottis' || type == "culture"){
            $(".min").prop("readonly",true);
            $(".maxx").prop("readonly",true);
        }else{
            $(".min").prop("readonly",false);
            $(".maxx").prop("readonly",false);
        }
    });

    $(".type_ex").on("change",function () {
        var type=$(".type_ex").val();
        if(type != 'min_max'){
            $(".min").prop("readonly",true);
            $(".maxx").prop("readonly",true);
        }else{
            $(".min").prop("readonly",false);
            $(".maxx").prop("readonly",false);
        }
    });


    $(".formulaire_modifier_groupe_examen").on('submit', (function (e) {
        $('#ajax-loading').show();
        e.preventDefault();
        var idex=$(".id_groupe").val();
        $.ajax({
            url: "app/DefaultApp/traitements/laboratoire.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    $(".message").html("<div class='alert alert-success'>Modifier avec success...</div>");
                    alert("Modifier avec success...");
                    document.location.href = 'modfier-groupe-exament-laboratoire-'+idex+'';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }
                $('#ajax-loading').hide();
            }
        });
    }));

    $(".forme_modifier_exament").on('submit', (function (e) {
        $('#ajax-loading').show();
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/laboratoire.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    $(".message").html("<div class='alert alert-success'>Modifier avec success...</div>");
                    alert("Modifier avec success...");
                    document.location.href = 'liste-exament-laboratoire';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }
                $('#ajax-loading').hide();
            }
        });
    }));

    $(".formulaire_ajouter_groupe_laboratoire").on('submit', (function (e) {
        $('#ajax-loading').show();
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/laboratoire.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    $(".message").html("<div class='alert alert-success'>Enregistrer avec success...</div>");
                    alert("Enregistrer avec success...");
                    document.location.href = 'groupe-exament-laboratoire?ajouter';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }
                $('#ajax-loading').hide();
            }
        });
    }));


    $(".formulaire_ajouter_patient").on('submit', (function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/patient.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if(data.trim()=="ok"){
                    alert("fait avec success");
                    location.reload(true);
                }else{
                    $(".message").html("<div class='alert alert-warning'>"+data+"</div>")
                }
                $("#load").hide();
            }
        });
    }));

    $(".specimen").on('submit', (function (e) {
        e.preventDefault();
        $('#load').show();
        $.ajax({
            url: "app/DefaultApp/traitements/laboratoire.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataTpe: "json",
            success: function (data) {
                if (data.trim() == "ok") {
                    $(".message").html("<div class='alert alert-success'>Fait avec success</div>");
                    alert("Fait avec success");
                    history.back();
                } else {
                    $(".message").html("<div class='alert alert-success'>" + data.trim() + "</div>");

                }
                $('#load').hide();
            }
        });

    }));

    $(".specimen_imagerie").on('submit', (function (e) {
        e.preventDefault();
        $('#load').show();
        $.ajax({
            url: "app/DefaultApp/traitements/imagerie.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataTpe: "json",
            success: function (data) {
                if (data.trim() == "ok") {
                    $(".message").html("<div class='alert alert-success'>Fait avec success</div>");
                    alert("Fait avec success");
                    history.back();
                } else {
                    $(".message").html("<div class='alert alert-success'>" + data.trim() + "</div>");

                }
                $('#load').hide();
            }
        });

    }));

    //stock

    $("#type_stock").change(function () {

        var type_stock = $("#type_stock").val();
        $("#ab").val(type_stock);
        if (type_stock == "unite") {
            $("#nb_unite").val($("#quantite").val());
            $("#nombre_total").val($("#quantite").val());
        } else {
            var quantite = $("#quantite").val();
            var nombre_unite = $("#nb_unite").val();
            var nombre_total = quantite * nombre_unite;
            $("#nombre_total").val(nombre_total);
            var cout_total = $("#cout_unitaire").val() * $("#nombre_total").val();
            $("#cout_total").val(cout_total);
        }
        var cout_total = $("#cout_unitaire").val() * $("#nombre_total").val();
        $("#cout_total").val(cout_total);
        $("#prix").val($("#cout_unitaire").val());
    });

    $("#nb_unite").change(function () {
        var type_stock = $("#type_stock").val();
        if (type_stock == "unite") {
            $("#nb_unite").val($("#quantite").val());
            $("#nombre_total").val($("#quantite").val());
        } else {
            var quantite = $("#quantite").val();
            var nombre_unite = $("#nb_unite").val();
            var nombre_total = quantite * nombre_unite;
            $("#nombre_total").val(nombre_total);
            var cout_total = $("#cout_unitaire").val() * $("#nombre_total").val();
            $("#cout_total").val(cout_total);
        }

        var cout_total = $("#cout_unitaire").val() * $("#nombre_total").val();
        $("#cout_total").val(cout_total);
        $("#prix").val($("#cout_unitaire").val());
    });

    $("#quantite").change(function () {
        var type_stock = $("#type_stock").val();
        if (type_stock == "unite") {
            $("#nb_unite").val($("#quantite").val());
            $("#nombre_total").val($("#quantite").val());
        } else {
            var quantite = $("#quantite").val();
            var nombre_unite = $("#nb_unite").val();
            var nombre_total = quantite * nombre_unite;
            $("#nombre_total").val(nombre_total);
            var cout_total = $("#cout_unitaire").val() * $("#nombre_total").val();
            $("#cout_total").val(cout_total);
        }

        var cout_total = $("#cout_unitaire").val() * $("#nombre_total").val();
        $("#cout_total").val(cout_total);
        $("#prix").val($("#cout_unitaire").val());

    });

    $("#cout_unitaire").change(function () {
        var cout_total = parseFloat($("#cout_unitaire").val() * $("#nombre_total").val());
        $("#prix").val($("#cout_unitaire").val());
        $("#cout_total").val(cout_total);
    });

    $("#markup").change(function () {
        var cout_total = parseFloat($("#cout_unitaire").val());
        var markup = parseInt($("#markup").val());
        markup /= 100;

        var aug = cout_total * markup;

        var prix = cout_total + aug;

        $("#prix").val(prix);
    });

    $("#prix").change(function () {
        var cout_achat = parseFloat($("#cout_unitaire").val());
        var cout_vent = parseFloat($("#prix").val())

        var markup = ((cout_vent / cout_achat) - 1) * 100;
        $("#markup").val(markup);
    });

    $("#type").change(function () {
        var type = $("#type").val();

        if (type == "Medicament") {

            $(".gm").prop('disabled', false);
        } else {
            $(".gm").prop('disabled', true);
        }
    });

    $(".quantite").change(function () {
        $("#load").show();
        var v = $(".auto_item").val();
        $.ajax({
            url: "app/DefaultApp/traitements/infos_repartition.php?item=" + v + "",
            type: "POST",
            data: "",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#load").hide();
                $(".tableau_repartition").html(data);
            }
        });

    });

    $(".req").change(function () {
        var v = $(".req").val();
        v = v.toLowerCase();
        var mag = $(".auto_item_ph");
        var phar = $(".auto_item_mag");

        if (v == "magasin") {
            mag.prop("disabled", true);
            mag.css("display", "none");

            phar.prop("disabled", false);
            phar.css("display", "inline");
        }

        if (v == "pharmacie") {
            mag.prop("disabled", false);
            mag.css("display", "inline");

            phar.prop("disabled", true);
            phar.css("display", "none");
        }
    });

    $(".quantite_magasin").change(function () {
        var v = $(".auto_item_magasin").val();
        $.ajax({
            url: "traitements/infos_repartition.php?item=" + v + "",
            type: "POST",
            data: "",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {

                $(".tableau_repartition").html(data);
            }
        });

    });

    $(".quantite_pharmacie").change(function () {
        var v = $(".auto_item_pharmacie").val();
        $.ajax({
            url: "traitements/infos_repartition.php?item=" + v + "",
            type: "POST",
            data: "",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {

                $(".tableau_repartition").html(data);
            }
        });

    });

    $(".de").change(function () {
        $("#load").show();
        var v = $(".auto_item").val();
        $.ajax({
            url: "app/DefaultApp/traitements/infos_repartition.php?item=" + v + "",
            type: "POST",
            data: "",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#load").hide();
                $(".tableau_repartition").html(data);
            }
        });

    });

    $(".a").change(function () {
        $("#load").show();
        var v = $(".auto_item").val();
        $.ajax({
            url: "app/DefaultApp/traitements/infos_repartition.php?item=" + v + "",
            type: "POST",
            data: "",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#load").hide();
                $(".tableau_repartition").html(data);
            }
        });

    });

    $(".location").change(function () {
        var v = $(".auto_item").val();
        $.ajax({
            url: "traitements/infos_repartition.php?item=" + v + "",
            type: "POST",
            data: "",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {

                $(".tableau_repartition").html(data);
            }
        });

    });

    $(".forme_transfert").on('submit', (function (e) {

        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("transferer avec success");
                    document.location.href = 'app.php?url=stock&type=magasin&action=repartition';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_repartition_general").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("transferer avec success");
                    document.location.href = 'repartition-item';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_transfert_ssa").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("transferer avec success");
                    document.location.href = 'app.php?url=stock&type=ssa';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_transfert_ssh").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("transferer avec success");
                    document.location.href = 'app.php?url=stock&type=ssh';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_transfert_ssu").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("transferer avec success");
                    document.location.href = 'app.php?url=stock&type=ssu';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_transfert_ssc").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("transferer avec success");
                    document.location.href = 'app.php?url=stock&type=ssc';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_repartition_magasin").on('submit', (function (e) {

        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("transferer avec success");
                    document.location.href = 'app.php?url=stock&type=magasin&action=repartition';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_repartition_pharmacie").on('submit', (function (e) {

        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("transferer avec success");
                    document.location.href = 'app.php?url=stock&type=pharmacie&action=repartition';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_confirmer_requisition_interne_ssc").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=ssc&action=requisition&type_requisition=ssc&statut=nl';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_confirmer_requisition_interne_ssh").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=ssh&action=requisition&type_requisition=ssh&statut=nl';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_confirmer_requisition_interne_ssu").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=ssu&action=requisition&type_requisition=ssu&statut=nl';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_confirmer_requisition_interne_ssa").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=ssa&action=requisition&type_requisition=ssa&statut=nl';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_finaliser_requisition_externe").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=magasin&action=commande';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_finaliser_requisition_externe_pharmacie").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=pharmacie&action=requisition&type_requisition=externe&action_requisition=lister&statut=livrer';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_confirmer_requisition_interne").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=magasin&action=requisition&type_requisition=interne&action_requisition=lister&statut=non';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_modifier_commande").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=aa&action=liste_commande';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_confirmer_requisition_externe").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=magasin&action=commande';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_confirmer_requisition_externe_pharmacie").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=pharmacie&action=requisition&type_requisition=externe&action_requisition=lister&statut=en_cour';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_confirmer_requisition_interne_pharmacie").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=pharmacie&action=requisition&type_requisition=interne&action_requisition=lister&statut=non';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_reception_requisition_interne_ssc").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=ssc&action=requisition&type_requisition=ssc&statut=encour';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_reception_requisition_interne_ssh").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=ssh&action=requisition&type_requisition=ssh&statut=encour';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_reception_requisition_interne_ssu").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=ssu&action=requisition&type_requisition=ssu&statut=encour';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_reception_requisition_interne_ssa").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=ssa&action=requisition&type_requisition=ssa&statut=encour';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $(".forme_reception_requisition_interne").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    document.location.href = 'app.php?url=stock&type=magasin&action=requisition&type_requisition=interne&action_requisition=lister&statut=non';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }

            }
        });
    }));

    $("#forme_ajouter_requisition_interne").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $data = $.parseJSON(data);
                if ($data['message'] == "ok") {
                    var ligne = "<tr>" +
                        "<td>" + $data['item'] + "</td>" +
                        "<td>" + $data['size'] + "</td>" +
                        "<td>" + $data['description'] + "</td>" +
                        "<td>" + $data['quantite'] + "</td>" +
                        "<td><input name='rnn' class='ch' value='" + $data['id'] + "' type='radio'/></td>" +
                        "</tr>";
                    $("#t>tbody:last").append(ligne);
                    $("#no_requisition").html($data['no_requisition']);
                    $("#message").html('');
                } else {
                    $("#message").html("<div class='alert alert-warning'>" + $data['message'] + "</div>");
                }

            }
        });
    }));

    $("#forme_ajouter_requisition_externe").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/requisition.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $data = $.parseJSON(data);
                if ($data['message'] == "ok") {
                    var ligne = "<tr>" +
                        "<td>" + $data['item'] + "</td>" +
                        "<td>" + $data['size'] + "</td>" +
                        "<td>" + $data['description'] + "</td>" +
                        "<td>" + $data['quantite'] + "</td>" +
                        "<td><input name='rnn' class='ch' value='" + $data['id'] + "' type='radio'/></td>" +
                        "</tr>";
                    $("#t>tbody:last").append(ligne);
                    $("#nr").html($data['no_requisition']);
                    $("#messages").html('');
                } else {
                    $("#messages").html("<div class='alert alert-warning'>" + $data['message'] + "</div>");
                }

            }
        });
    }));

    $(".forme_confirmer_requisition_pharmacie").on('submit', (function (e) {

        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("transferer avec success");
                    document.location.href = 'app.php?url=stock&type=pharmacie&action=requisition&type_requisition=externe';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_confirmer_requisition_magasin").on('submit', (function (e) {

        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("transferer avec success");
                    document.location.href = 'app.php?url=stock&type=magasin&action=requisition&type_requisition=externe';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_confirmer_requisition_general").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("transferer avec success");
                    document.location.href = 'app.php?url=stock&type=stock_generale&action=requisition&type_requisition=externe';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_transfert_magasin").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("Transferer avec success");
                    document.location.href = 'app.php?url=stock&type=magasin&action=transfert';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_transfert_pharmacie").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("Transferer avec success");
                    document.location.href = 'app.php?url=stock&type=pharmacie&action=transfert';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_transfert_generale").on('submit', (function (e) {
        $("#load").show();
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#load").hide();
                if (data.trim() == "ok") {
                    alert("Transferer avec success");
                    document.location.href = 'transfert-item';
                } else {
                    $(".message").html(data);
                }
            }
        });
    }));

    $(".forme_retirer_pharmacie").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("Retirer avec success");
                    document.location.href = 'app.php?url=stock&type=pharmacie&action=retirer';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_retirer_magasin").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("Retirer avec success");
                    document.location.href = 'app.php?url=stock&type=magasin&action=retirer';
                } else {
                    $(".message").html(data);
                }


            }
        });
    }));

    $(".forme_retirer_generale").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("Retirer avec success");
                    document.location.href = 'retirer-item';
                } else {
                    $(".message").html(data);
                }

            }
        });
    }));

    $(".forme_bon").on('submit', (function (e) {
        $("#load").show();
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("Utiliser avec success");
                    document.location.href = 'bon-utilisation';
                } else {
                    $(".message").html(data);
                }
                $("#load").hide();
            }
        });
    }));

    $(".forme_requisition").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("Fait avec sucess");
                    document.location.href = 'app.php?url=stock&type=magasin&action=transfert';
                } else {
                    $(".message").html(data);
                }
            }
        });
    }));

    $(".forme_requisition_pharmacie_interne").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("Fait avec sucess");
                    document.location.href = 'app.php?url=stock&type=pharmacie&action=requisition&type_requisition=interne&action_requisition=ajouter';
                } else {
                    $(".message").html(data);
                }
            }
        });
    }));

    $(".forme_requisition_pharmacie_externe").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "traitements/transfert_stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("Fait avec sucess");
                    document.location.href = 'app.php?url=stock&type=pharmacie&action=requisition&type_requisition=externe&action_requisition=ajouter';
                } else {
                    $(".message").html(data);
                }
            }
        });
    }));

    $("#nouveau_produit").on('submit', (function (e) {
        e.preventDefault();
        $("#ajax-loading").show();
        $.ajax({
            url: "app/DefaultApp/traitements/stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("Enregistrer avec success");
                    document.location.href = 'nouveau-item';
                } else {
                    $('#message').html("<div class='alert alert-danger'>" + data + "</div>");
                }
                $("#ajax-loading").hide();
            }
        });
    }));

    $("#nouveau_produit1").on('submit', (function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("Enregistrer avec success");
                    document.location.href = 'nouveau-item';
                } else {
                    $('#message').html("<div class='alert alert-danger'>" + data + "</div>");
                }
                $("#load").hide();
            }
        });
    }));

    $("#nouveau_produit3").on('submit', (function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("Enregistrer avec success");
                    document.location.href = 'nouveau-item';
                } else {
                    $('.message').html("<div class='alert alert-danger'>" + data + "</div>");
                }
                $("#load").hide();
            }
        });
    }));

    $("#existant").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/stock.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                //alert("tout est ok");
                $('.message').html(data);
                var counter2 = 10;
                var interval = setInterval(function () {
                    counter2--;
                    var mess = "redirection dans : " + counter2 + " secondes";
                    $('.message').html("<div class='alert alert-success' style='margin:2px'> " + mess + " </div>");
                    if (counter2 == 0) {
                        document.location.href = "nouveau-item";
                    }
                }, 1000);
            }
        });
    }));

    $('#infos').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#numero').val(rowid);
        $.ajax({
            type: 'POST',
            url: 'app/DefaultApp/traitements/infos.php',
            data: 'numero=' + rowid,
            beforeSend: function () {

            },
            success: function (data) {
                $('.fetched-data').html(data);
            }

        });

    });

    $('#entrer').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $('#numero').val(rowid);
        $.ajax({

            type: 'POST',
            url: 'app/DefaultApp/traitements/entrer.php',
            data: 'numero=' + rowid,
            beforeSend: function () {

            },
            success: function (data) {
                $('.fetched-data').html(data);
            }

        });

    });

    $('#repartir').on('show.bs.modal', function (e) {

        var rowid = $(e.relatedTarget).data('id');

        /*$('#numero').val(rowid);

         $.ajax({

         type : 'POST',
         url  : 'entrer.php',
         data :'numero='+ rowid,
         beforeSend: function()
         {

         },
         success :  function(data)
         {
         $('.fetched-data').html(data);
         }

         });*/

    });

    $('#sortie').on('show.bs.modal', function (e) {

        var rowid = $(e.relatedTarget).data('id');
        $('#numero').val(rowid);

        $.ajax({

            type: 'POST',
            url: 'sortie.php',
            data: 'numero=' + rowid,
            beforeSend: function () {

            },
            success: function (data) {
                $('.fetched-data').html(data);
            }

        });

    });

    $('#repartition').on('show.bs.modal', function (e) {

        var rowid = $(e.relatedTarget).data('id');
        $('#numero').val(rowid);

        $.ajax({

            type: 'POST',
            url: 'repartition.php',
            data: 'numero=' + rowid,
            beforeSend: function () {

            },
            success: function (data) {
                $('.fetched-data').html(data);
            }

        });

    });

    $('#repartition2').on('show.bs.modal', function (e) {

        var rowid = $(e.relatedTarget).data('id');
        $('#numero').val(rowid);

        $.ajax({

            type: 'POST',
            url: 'repartition_medicament.php',
            data: 'numero=' + rowid,
            beforeSend: function () {

            },
            success: function (data) {
                $('.fetched-data').html(data);
            }

        });

    });

    //fin stock

    //auto choz

    $('.examen_sono').autocomplete({
        source: 'app/DefaultApp/traitements/autocomplet_examen_sono.php',
        dataType: 'json',
    });

    $('.examen_mamo').autocomplete({
        source: 'app/DefaultApp/traitements/autocomplet_examen_mamo.php',
        dataType: 'json',
    });

    $('.examen_scanner').autocomplete({
        source: 'app/DefaultApp/traitements/autocomplet_examen_scanner.php',
        dataType: 'json',
    });

    $('.auto_exament').autocomplete({
        source: 'app/DefaultApp/traitements/auto_exament',
        dataType: 'json',
    });

    $('.auto_item').autocomplete({
        source: 'app/DefaultApp/traitements/auto_item.php',
        dataType: 'json',
    });


    $('.auto_item_ph').autocomplete({
        source: 'app/DefaultApp/traitements/auto_item.php?pharmacie',
        dataType: 'json',
    });

    $('.auto_item_mag').autocomplete({
        source: 'app/DefaultApp/traitements/auto_item.php?magasin',
        dataType: 'json',
    });

    $('.auto_item1').autocomplete({
        source: 'app/DefaultApp/traitements/auto_item1.php',
        dataType: 'json',
    });

    $('.auto_item_magasin').autocomplete({
        source: 'app/DefaultApp/traitements/auto_item_magasin.php',
        dataType: 'json',
    });

    $('.auto_item_pharmacie').autocomplete({
        source: 'app/DefaultApp/traitements/auto_item_pharmacie.php',
        dataType: 'json',
    });

    $('.auto_item_service').autocomplete({
        source: 'app/DefaultApp/traitements/auto_item_service.php',
        dataType: 'json',
    });

    $('.location_inventaire').change(function () {
        $('#load').show();
        var location=$(".location_inventaire").val();
        $.ajax({
            type: 'GET',
            url: 'app/DefaultApp/traitements/liste_stock.php?location='+location+'',
            data: "",
            success: function (datas) {
                $(".tlst:last").empty();
                $(".tlst:last").append(datas);
                $('#load').hide();
            }
        });

    });

    $(".ajuster_quantite").on("submit",function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            type: 'POST',
            url: 'app/DefaultApp/traitements/stock.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (datas) {
                if(datas.trim()=="ok"){
                    $(".message").html("<div class='alert alert-success'>Fait Avec success</div>")
                    alert("fait avec success");
                    location.reload(true);
                }else{
                    $(".message").html("<div class='alert alert-warning'>"+datas+"</div>")
                }
                $("#load").hide();
            }
        });
    });

    $(".forme_inventory").on("submit",function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            type: 'POST',
            url: 'app/DefaultApp/traitements/traitement_inventory.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (datas) {
                if(datas.trim()=="ok"){
                    $(".message").html("<div class='alert alert-success'>Fait Avec success</div>")
                    alert("fait avec success");
                    location.reload(true);
                }else{
                    $(".message").html("<div class='alert alert-warning'>"+datas+"</div>")
                }
                $("#load").hide();
            }
        });
    });

    //fin auto choz

    $("#f_categorie").on('submit', (function (e) {
        $("#load").show();
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/autre_item.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#load").hide();
                if (data.trim() == "ok") {
                    alert("ajouter avec success");
                    document.location.href = 'ajouter-autre-item'
                } else {
                    $(".message").html(data);
                }

            }
        });
    }));

    $("#f_ajouter_autre_item").on('submit', (function (e) {
        $("#load").show();
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/autre_item.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#load").hide();
                if (data.trim() == "ok") {
                    alert("ajouter avec success");
                    document.location.href = 'lister-autre-item'
                } else {
                    $(".message1").html(data);
                }

            }
        });
    }));

    $("#type_ass").on('change', (function (e) {
        var val = $("#type_ass").val();
        if (val == "secondaire") {
            $(".primaire").prop("readonly", false)
        } else {
            $(".primaire").prop("readonly", true)
        }
    }));

    $(".fass").on('submit', (function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/patient.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("ajouter avec success");
                    location.reload(true);
                    $(".ajouter_assurance").modal("toggle")
                } else {
                    $(".message").html(data);
                }
                $("#load").hide();
            }
        });
    }));

    $(".fap").on('submit', (function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/patient.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $(".message").html(data);
                if (data.trim() == "ok") {
                    alert("enregistrer avec success");
                    history.back();
                }
                $("#load").hide();
            }
        });
    }));

    $(".type_chambre").on("change", function () {
        $("#load").show();
        var type = $(".type_chambre").val();
        var service=$(".id_service").val();
        var data = {
            "type": type,
            "service":service
        };
        $.ajax({
            type: 'POST',
            url: 'app/DefaultApp/traitements/admision.php?type_chambre',
            data: data,
            success: function (reponse) {
                $(".llit").empty();
                $(".llit").append(reponse);
                $("#load").hide();
            }
        });
    });


    $(".type_admision").on("change", function () {
        $("#load").show();
            var val =$(".type_admision").val();
            if(val=="admision"){
                $(".divpre").css("display","none");
            }else{
                $(".divpre").css("display","inline");
            }
        $("#load").hide();
    });

    $(".admis_pour").on("change", function () {
        $("#load").show();
        var val =$(".admis_pour").val();
        if(val=="hospitalisation"){
            $(".divch").css("display","none");
        }else{
            $(".divch").css("display","inline");
        }
        $("#load").hide();
    });

    $(".fadmision").on('submit', (function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/admision.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("enregistrer avec success");
                    history.back();
                }else{
                    $(".message").html("<div class='alert alert-warning'>"+data+"</div>");
                }
                $("#load").hide();
            }
        });
    }));

    $(".forme_trasfert_lit").on('submit', (function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/admision.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    location.reload(true);
                }else{
                    $(".message").html("<div class='alert alert-warning'>"+data+"</div>");
                }
                $("#load").hide();
            }
        });
    }));

    $(".forme_transfert_service").on('submit', (function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/admision.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    alert("fait avec success");
                    location.reload(true);
                }else{
                    $(".message").html("<div class='alert alert-warning'>"+data+"</div>");
                }
                $("#load").hide();
            }
        });
    }));

    $(".service_transfer").change(function () {
        var $service = $('.service_transfer').val();
        $.ajax({
            type: 'POST',
            url: 'app/DefaultApp/traitements/liste_lit_transfer.php?service=' + $service + '',
            data: $service,
            success: function (reponse) {
                $('.lit_t').empty();
                $(".lit_t").append(reponse);
            }

        });

    });

    $("#btn_add").on("click", function (e) {
        e.preventDefault();
        var nom_item = $(".auto_item").val();
        if (nom_item == "") {
            $("#erreur").html("Entrer un nom item");
        } else {
            $("#erreur").html("");
            $.ajax({
                url: "app/DefaultApp/traitements/ajouter_element_bdc.php?nom_item=" + nom_item + "",
                type: "GET",
                data: "",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    var resultat = $.parseJSON(data);
                    if (resultat['erreur']) {
                        $("#erreur").html(resultat['erreur']);
                    } else {
                        $('.ajout_element').append("<div class='col-md-4'>" +
                            "<label class=''>" + resultat['nom_item'] + "</label>" +
                            "<input required class='' type='number' min='1' name='qt-" + resultat['id_item'] + "'>" +
                            "<input required class='' checked type='checkbox' name='" + resultat['id_item'] + "' value='" + resultat['id_item'] + "'/>" +
                            "</div>");
                    }
                }
            });
        }


    });

    $("#forme_bdc").on("submit", function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/ajouter_bdc.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#load").hide();
                if (data.trim() == "ok") {
                    $(".message").html("Enregistrer avec success");
                    alert("Enregistrer avec success");
                    location.reload(true);

                } else {
                    $(".message").html(data);
                }

            }
        });

    });

    $(".form_exeat").on("submit", function (e) {
        e.preventDefault();
        $("#load").show();
        $.ajax({
            url: "app/DefaultApp/traitements/patient.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#load").hide();
                if (data.trim() == "ok") {
                    $(".message").html("Fait avec success");
                    alert("Fait avec success");
                    history.back();
                } else {
                    $(".message").html(data);
                }

            }
        });

    });

    //consultation
    $(".type_consultation").on("click", function (e) {
        if ($(this).prop('checked') == true) {
            var valeur=$(this).val();
            if(valeur=="post_natal"){
                $(".div_postnatal").css("display","block");
                $(".div_pediatrie").css("display","none");
                $(".div_premiere_adulte").css("display","none");
                $(".div_adulte").css("display","none");
                $(".div_premiere_obgyn").css("display","none");
                $(".div_obgyn").css("display","none");
                $(".div_urgence").css("display","none");
            }else if(valeur=="pediatrie"){
                $(".div_postnatal").css("display","none");
                $(".div_pediatrie").css("display","block");
                $(".div_premiere_adulte").css("display","none");
                $(".div_adulte").css("display","none");
                $(".div_premiere_obgyn").css("display","none");
                $(".div_obgyn").css("display","none");
                $(".div_urgence").css("display","none");
            }else if(valeur=="premiere_adulte"){
                $(".div_postnatal").css("display","none");
                $(".div_pediatrie").css("display","none");
                $(".div_premiere_adulte").css("display","block");
                $(".div_adulte").css("display","none");
                $(".div_premiere_obgyn").css("display","none");
                $(".div_obgyn").css("display","none");
                $(".div_urgence").css("display","none");
            }else if(valeur=="adulte"){
                $(".div_postnatal").css("display","none");
                $(".div_pediatrie").css("display","none");
                $(".div_premiere_adulte").css("display","none");
                $(".div_adulte").css("display","block");
                $(".div_premiere_obgyn").css("display","none");
                $(".div_obgyn").css("display","none");
                $(".div_urgence").css("display","none");
            }else if(valeur=="premiere_obgyn"){
                $(".div_postnatal").css("display","none");
                $(".div_pediatrie").css("display","none");
                $(".div_premiere_adulte").css("display","none");
                $(".div_adulte").css("display","none");
                $(".div_premiere_obgyn").css("display","block");
                $(".div_obgyn").css("display","none");
                $(".div_urgence").css("display","none");
            }else if(valeur=="obgyn"){
                $(".div_postnatal").css("display","none");
                $(".div_pediatrie").css("display","none");
                $(".div_premiere_adulte").css("display","none");
                $(".div_adulte").css("display","none");
                $(".div_premiere_obgyn").css("display","none");
                $(".div_obgyn").css("display","block");
                $(".div_urgence").css("display","none");
            }else if(valeur=="urgence"){
                $(".div_postnatal").css("display","none");
                $(".div_pediatrie").css("display","none");
                $(".div_premiere_adulte").css("display","none");
                $(".div_adulte").css("display","none");
                $(".div_premiere_obgyn").css("display","none");
                $(".div_obgyn").css("display","none");
                $(".div_urgence").css("display","block");
            }
        }
    });

    $(".formulaire_consultation").on('submit', (function (e) {
        $('#load').show();
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/patient.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    $(".message").html("<div class='alert alert-success'>Consultation Ajouter Avec succes</div>");
                    alert("consultation ajouter avec success");
                    document.location.href='lister-patient';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }
                $('#load').hide();
            }
        });
    }));

    $(".forme_consultation").on('submit', (function (e) {
        $('#load').show();
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/consultation.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.trim() == "ok") {
                    $(".message").html("<div class='alert alert-success'>Consultation Ajouter Avec succes</div>");
                    alert("consultation ajouter avec success");
                    document.location.href='lister-patient';
                } else {
                    $(".message").html("<div class='alert alert-warning'>" + data + "</div>");
                }
                $('#load').hide();
            }
        });
    }));

    //fin consultation



















});