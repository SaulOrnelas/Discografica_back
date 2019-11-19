<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title></title>
    <!--CDN para la tipografía (Muli)-->
    <link
      href="https://fonts.googleapis.com/css?family=Muli"
      rel="stylesheet"
      type="text/css"
    />
    <!--CDN Para los iconos-->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
      integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
      crossorigin="anonymous"
    />
    <style type="text/css">
      
      .banner {
        width: 100%;
				height: 200px;
				overflow: hidden;
				margin: 10px;
				position: relative;
      }
			.img_banner {
				position:absolute;
				left: -100%;
				right: -100%;
				top: -100%;
				bottom: -100%;
				margin: auto;
				min-height: 100%;
				min-width: 100%;
			}
      .footer {
          width: 100%;
          height: 250px;
          text-align: center;
          align-items: center;
          justify-content: center;
          margin-top: 100px;
          left:0px;
          bottom:0px;
          background-color: #343a40;
      }
      
      .roundImage {
            width: 120px;
            height: 120px;
            margin-right: 30px;
        }
        .organizadorName {
            font-size: 160%;
        }
        .text {
            font-size: 110%;
        }
​
      @media (max-width: 900px){
        .infoOrganizador {
            margin: 35px 15px 35px 15px;
            display: flex;
            align-items: center
        }
        .infoContainer {
            margin: 15px 15px 35px 15px;
            padding: 10px;
        }
        .bodyMargin {
            margin: 0px;
        }
      }
      @media (min-width: 901px){
        .infoOrganizador {
            margin: 50px;
            display: flex;
            align-items: center
        }
        .infoContainer {
            margin: 20px 50px 10px 50px;
            padding: 10px;
        }
        .bodyMargin {
            margin-left: 20%;
            margin-right: 20%;
        }
      }
    </style>
  </head>
  <body class="bodyMargin">
		<div class="banner">
			<img class="img_banner" src="https://www.lavanguardia.com/r/GODO/LV/p5/WebSite/2018/02/19/Recortada/img_rpeco_20180219-142613_imagenes_lv_otras_fuentes_istock-108195157-kGfE-U44920520729RIE-992x558@LaVanguardia-Web.jpg" alt="Banner" width="100%">
		</div>
    <!--Banner-->
​
    <!--Info organizador-->
    <div class="infoOrganizador">
      <img src="https://images.vexels.com/media/users/3/153250/isolated/preview/0a94d13648e32f6af10d8dbb16c7adbe-icono-plano-del-disco-de-la-nota-musical-by-vexels.png" class="roundImage"></img>
      <span class="organizadorName">
        Discográfica
      </span>
    </div>
​
    <!--Mensaje bienvenida-->
    <div>
        <span class="text">
					Que tal, buen día {!! $name !!}. Te informamos que tu usuario ha sido creado de forma exitosa.
        </span>
    </div>
​
    <!--Mensaje bienvenida-->
    <div>
        <span class="text">
					Nos esforzamos cada día para ofrecer el mejor servicio, gracias a esto contamos con los últimos lanzamientos de tus artistas favoritos y ahora que cuentas con un usuario puedes ver todos nuestros productos así como su existencia desde la comodidad de tu casa para que tengas la seguridad de que al momento de acudir a la sucursal de tu preferencia encuentres el producto que deseas comprar.
        </span>
    </div>
​
    <!--Logo Empresa-->
    <div class="footer">
            <img src="https://images.vexels.com/media/users/3/153250/isolated/preview/0a94d13648e32f6af10d8dbb16c7adbe-icono-plano-del-disco-de-la-nota-musical-by-vexels.png" alt="WeChamber" width="134px">
            <p style="color:#FFFFFF">Copyright 2019, Discográfica S.A. de C.V. All Rights Reserved.</p>
    </div>
  </body>
</html>
