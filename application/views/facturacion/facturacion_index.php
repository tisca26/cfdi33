<!DOCTYPE html>
<!--[if IE 8]>
<html lang="es" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="es" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>Bill E Zone</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Preview page of Metronic Admin Theme #3 for " name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN PAGE FIRST SCRIPTS -->
    <script src="<?php echo cdn_assets(); ?>global/plugins/pace/pace.min.js" type="text/javascript"></script>
    <!-- END PAGE FIRST SCRIPTS -->
    <!-- BEGIN PAGE TOP STYLES -->
    <link href="<?php echo cdn_assets(); ?>global/plugins/pace/themes/pace-theme-big-counter.css" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE TOP STYLES -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
          rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo cdn_assets(); ?>global/css/components.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?php echo cdn_assets(); ?>layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo cdn_assets(); ?>layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="<?php echo cdn_assets(); ?>layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid">
<div class="page-wrapper">
    <?php echo $this->cargar_elementos_manager->carga_simple('menus/menu_completo'); ?>
    <div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <div class="container-fluid">
                            <!-- BEGIN PAGE TITLE -->
                            <div class="page-title">
                                <h1> Facturación </h1>
                            </div>
                            <!-- END PAGE TITLE -->
                        </div>
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE CONTENT BODY -->
                    <div class="page-content">
                        <div class="container">
                            <!-- BEGIN PAGE BREADCRUMBS -->
                            <ul class="page-breadcrumb breadcrumb">
                                <li>
                                    <a href="<?php echo base_url(); ?>">Inicio</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Facturación</span>
                                </li>
                            </ul>
                            <!-- END PAGE BREADCRUMBS -->
                            <!-- BEGIN PAGE CONTENT INNER -->
                            <div class="page-content-inner">
                                <?php echo form_open('facturacion/insertar'); ?>
                                <div class="row">
                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                        <div class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-dark hide"></i>
                                                    <span class="caption-subject font-dark bold uppercase">Emisor</span>
                                                    <span class="caption-helper"> Persona que emite la factura </span>
                                                </div>
                                                <div class="tools">
                                                    <a href="" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <?php $varias_personas = false; ?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Nombre o Razón Social
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <?php if (count($personas) > 1): ?>
                                                                <?php $data_nombre_razon_social = [
                                                                    'id' => 'nombre_razon_social',
                                                                    'placeholder' => 'Nombre o Razón Social',
                                                                    'class' => 'form-control selectpicker',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    "data-live-search" => "true",
                                                                    "data-size" => "5",
                                                                    "title" => "- Seleccione -",
                                                                    "data-live-search-normalize" => "true"
                                                                ];
                                                                $personas_sel = array();
                                                                foreach ($personas as $persona) {
                                                                    $personas_sel[$persona->personas_id] = $persona->nombre;
                                                                }
                                                                $varias_personas = true;
                                                                ?>
                                                                <?php echo form_dropdown('nombre_razon_social', $personas_sel, '', $data_nombre_razon_social); ?>
                                                            <?php else: ?>
                                                                <?php $data_nombre_razon_social = [
                                                                    'id' => 'nombre_razon_social',
                                                                    'placeholder' => 'Nombre o Razón Social',
                                                                    'class' => 'form-control',
                                                                    'data-rule-required' => 'true',
                                                                    'data-msg-required' => 'Este campo es requerido',
                                                                    'disabled' => 'true'
                                                                ]; ?>
                                                                <?php echo form_input('', $personas[0]->nombre, $data_nombre_razon_social); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">RFC
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <?php $data_emisor_rfc = [
                                                                'id' => 'rfc_emisor',
                                                                'placeholder' => 'RFC del emisor',
                                                                'class' => 'form-control',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido',
                                                                'disabled' => 'true'
                                                            ]; ?>
                                                            <?php echo form_input('rfc_emisor', ($varias_personas) ? '' : $personas[0]->rfc, $data_emisor_rfc); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Regimen Fiscal
                                                                <span class="required"> * </span></label>
                                                            <?php $data_regimen_fiscal = [
                                                                'id' => 'regimen_fiscal',
                                                                'placeholder' => 'Régimen Fiscal del Emisor',
                                                                'class' => 'form-control',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido',
                                                                'disabled' => 'true'
                                                            ]; ?>
                                                            <?php echo form_input('', ($varias_personas) ? '' : $personas[0]->descripcion, $data_regimen_fiscal); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-sm-12">
                                        <div class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-dark hide"></i>
                                                    <span class="caption-subject font-dark bold uppercase">Receptor</span>
                                                    <span class="caption-helper"> Persona que recibe la factura </span>
                                                </div>
                                                <div class="tools">
                                                    <a href="" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label"> Nombre o Razón Social</label>
                                                            <?php $data_nombre_receptor = [
                                                                'id' => 'nombre_receptor',
                                                                'placeholder' => 'Nombre o Razón Social',
                                                                'class' => 'form-control selectpicker',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido',
                                                                "data-live-search" => "true",
                                                                "data-size" => "5",
                                                                "title" => "- Seleccione -",
                                                                "data-live-search-normalize" => "true"
                                                            ];
                                                            $clientes_sel = array();
                                                            foreach ($clientes as $cliente) {
                                                                $clientes_sel[$cliente->clientes_id] = $cliente->nombre;
                                                            }
                                                            ?>
                                                            <?php echo form_dropdown('nombre_receptor', $clientes_sel, '', $data_nombre_receptor); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">RFC
                                                                <span class="required"> * </span></label>
                                                            <?php $data_receptor_rfc = [
                                                                'id' => 'rfc_receptor',
                                                                'placeholder' => 'RFC del receptor',
                                                                'class' => 'form-control',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido',
                                                                'disabled' => 'true'
                                                            ]; ?>
                                                            <?php echo form_input('receptor[Rfc]', set_value('receptor[Rfc]'), $data_receptor_rfc); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Uso de CFDI
                                                                <span class="required"> * </span></label>
                                                            <?php $data_uso_de_cfdi = [
                                                                'id' => 'uso_cfdi',
                                                                'placeholder' => 'Uso de CFDI',
                                                                'class' => 'form-control selectpicker',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido',
                                                                "data-live-search" => "true",
                                                                "data-size" => "5",
                                                                "title" => "- Seleccione -",
                                                                "data-live-search-normalize" => "true",
                                                                "data-width" => '100%'
                                                            ];
                                                            $uso_cfdi_sel = array();
                                                            foreach ($cat_uso_cfdi as $item) {
                                                                $uso_cfdi_sel[$item->cat_uso_cfdi_id] = $item->descripcion;
                                                            }
                                                            ?>
                                                            <?php echo form_dropdown('uso_cfdi', $uso_cfdi_sel, '', $data_uso_de_cfdi); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <span id="repector_extranjero_span" style="display: none;">
                                                                <label class="control-label"> Este receptor es extranjero </label>
                                                                <label class="control-label text-warning"> * Si esta información es incorrecta, corrijala antes de generar la factura.</label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 col-sm-12">
                                        <div class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-dark hide"></i>
                                                    <span class="caption-subject font-dark bold uppercase">Generales</span>
                                                    <span class="caption-helper"> Datos generales del comprobante </span>
                                                </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body ">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tipo de comprobante
                                                                <span class="required"> * </span></label>
                                                            <?php $data_tipo_comprobante = [
                                                                'id' => 'tipo_comprobante',
                                                                'placeholder' => 'Tipo de comprobante del CFDI',
                                                                'class' => 'form-control selectpicker',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido',
                                                                "data-live-search" => "true",
                                                                "data-size" => "5",
                                                                "title" => "- Seleccione -",
                                                                "data-live-search-normalize" => "true",
                                                                "data-width" => '100%'
                                                            ];
                                                            $tipo_comprobabnte_sel = array();
                                                            foreach ($cat_tipo_de_comprobante as $item) {
                                                                $tipo_comprobabnte_sel[$item->cat_tipo_de_comprobante_id] = $item->descripcion;
                                                            }
                                                            ?>
                                                            <?php echo form_dropdown('tipo_comprobante', $tipo_comprobabnte_sel, '', $data_tipo_comprobante); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label"> Serie </label>
                                                            <?php $data_serie = [
                                                                'id' => 'serie',
                                                                'placeholder' => 'Serie del CFDI',
                                                                'class' => 'form-control'
                                                            ]; ?>
                                                            <?php echo form_input('serie', set_value('serie'), $data_serie); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label"> Folio </label>
                                                            <?php $data_folio = [
                                                                'id' => 'folio',
                                                                'placeholder' => 'Folio del CFDI, relacionado con la serie',
                                                                'class' => 'form-control',
                                                                'disabled' => 'true'
                                                            ]; ?>
                                                            <?php echo form_input('folio', set_value('folio'), $data_folio); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label"> Fecha <span class="required"> * </span>
                                                            </label>
                                                            <?php $data_fecha = [
                                                                'id' => 'fecha',
                                                                'placeholder' => 'Fecha del CFDI',
                                                                'class' => 'form-control',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido',
                                                                'data-rule-dateiso' => 'true',
                                                                'data-msg-dateiso' => 'Formato de fecha incorrecta'
                                                            ]; ?>
                                                            <?php echo form_input('fecha', set_value('fecha'), $data_fecha); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label"> Lugar de Expedición
                                                                <span class="required"> * </span></label>
                                                            <?php $data_tipo_comprobante = [
                                                                'id' => 'lugar_expedicion',
                                                                'placeholder' => 'Código Postal del lugar de expedición',
                                                                'class' => 'form-control',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido'
                                                            ]; ?>
                                                            <?php echo form_input('lugar_expedicion', set_value('lugar_expedicion'), $data_tipo_comprobante); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label"> Moneda <span class="required"> * </span></label>
                                                            <?php $data_moneda = [
                                                                'id' => 'moneda',
                                                                'placeholder' => 'Moneda del CFDI',
                                                                'class' => 'form-control selectpicker',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido',
                                                                "data-live-search" => "true",
                                                                "data-size" => "5",
                                                                "title" => "- Seleccione -",
                                                                "data-live-search-normalize" => "true",
                                                                "data-width" => '100%'
                                                            ];
                                                            $moneda_sel = array();
                                                            foreach ($cat_moneda as $item) {
                                                                $moneda_sel[$item->cat_moneda_id] = $item->clave;
                                                            }?>
                                                            <?php echo form_dropdown('moneda', $moneda_sel, '100', $data_moneda); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label"> Tipo de Cambio <span
                                                                        class="required"> * </span> </label>
                                                            <?php $data_tipo_modificar = [
                                                                'id' => 'tipo_cambio',
                                                                'placeholder' => 'Solo modificar si es diferente de MXN',
                                                                'class' => 'form-control',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido'
                                                            ]; ?>
                                                            <?php echo form_input('tipo_cambio', set_value('tipo_cambio', '1.00'), $data_tipo_modificar); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="extra_tipo_comprobante" class="row" style="display: none;">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label"> Forma de Pago </label>
                                                            <?php $data_forma_de_pago = [
                                                                'id' => 'forma_de_pago',
                                                                'placeholder' => 'Forma de pago del CFDI',
                                                                'class' => 'form-control selectpicker',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido',
                                                                "data-live-search" => "true",
                                                                "data-size" => "5",
                                                                "title" => "- Seleccione -",
                                                                "data-live-search-normalize" => "true",
                                                                "data-width" => '100%'
                                                            ];
                                                            $forma_pago_sel = array();
                                                            foreach ($cat_forma_pago as $item) {
                                                                $forma_pago_sel[$item->cat_forma_pago_id] = $item->descripcion;
                                                            }?>
                                                            <?php echo form_dropdown('forma_de_pago', $forma_pago_sel, '', $data_forma_de_pago); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label"> Método de Pago </label>
                                                            <?php $data_metodo_de_pago = [
                                                                'id' => 'moneda',
                                                                'placeholder' => 'Moneda del CFDI',
                                                                'class' => 'form-control selectpicker',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido',
                                                                "data-live-search" => "true",
                                                                "data-size" => "5",
                                                                "title" => "- Seleccione -",
                                                                "data-live-search-normalize" => "true",
                                                                "data-width" => '100%'
                                                            ];
                                                            $metodo_pago_sel = array();
                                                            foreach ($cat_metodo_pago as $item) {
                                                                $metodo_pago_sel[$item->cat_metodo_pago_id] = $item->descripcion;
                                                            }?>
                                                            <?php echo form_dropdown('metodo_de_pago', $metodo_pago_sel, '', $data_metodo_de_pago); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label"> Condiciones de Pago </label>
                                                            <?php $data_condiciones_de_pago = [
                                                                'id' => 'condiciones_pago',
                                                                'placeholder' => 'Condiciones de pago',
                                                                'class' => 'form-control',
                                                                'data-rule-maxlength' => '1000',
                                                                'data-msg-maxlength' => 'El número máximo de caracteres es de 1000',
                                                            ]; ?>
                                                            <?php echo form_input('condiciones_pago', set_value('condiciones_pago'), $data_condiciones_de_pago); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 col-sm-12">
                                        <div class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-dark hide"></i>
                                                    <span class="caption-subject font-dark bold uppercase">CFDI relacionados</span>
                                                    <span class="caption-helper"> Comprobantes relacionados (solo en caso de ser necesario) </span>
                                                </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="expand"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body portlet-collapsed">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Tipo de relación
                                                                <span class="required"> * </span></label>
                                                            <?php $data_tipo_relacion = [
                                                                'id' => 'tipo_relacion',
                                                                'placeholder' => 'Tipo de relación con los CFDI',
                                                                'class' => 'form-control',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido'
                                                            ]; ?>
                                                            <?php echo form_input('cfdirelacionados[TipoRelacion]', set_value('cfdirelacionados[TipoRelacion]'), $data_tipo_relacion); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label class="control-label"> CFDI:
                                                                    <span class="required"> * </span></label>
                                                            </div>
                                                            <?php $data_cfdi_rel = [
                                                                'id' => 'cfdi',
                                                                'placeholder' => 'CFDI a relacionar',
                                                                'class' => 'form-control',
                                                                'data-rule-required' => 'true',
                                                                'data-msg-required' => 'Este campo es requerido'
                                                            ]; ?>
                                                            <div class="col-md-11">
                                                                <?php echo form_input('cfdirelacionado[CFDI][]', set_value('cfdirelacionado[CFDI][]'), $data_cfdi_rel); ?>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <a class="btn btn-info"> <i class="fa fa-plus"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 col-sm-12">
                                        <div class="portlet light ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-dark hide"></i>
                                                    <span class="caption-subject font-dark bold uppercase">Conceptos</span>
                                                    <span class="caption-helper"> Conceptos incluidos en el CFDI </span>
                                                </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a class="btn btn-warning" data-toggle="modal"
                                                           href="#agregar_concepto"><i class="fa fa-plus"></i>
                                                            Agregar concepto
                                                        </a>
                                                    </div>
                                                    <br><br><br>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover"
                                                           id="tabla_conceptos">
                                                        <thead>
                                                        <tr>
                                                            <th> Conceptos</th>
                                                            <th class="text-center"> Clave Producto</th>
                                                            <th class="text-center"> Cantidad</th>
                                                            <th class="text-center"> Importe</th>
                                                            <th class="text-center"> Opciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td> Concpeto ejemplo de la factura correspondiente al
                                                                periodo xx-xxxxx-xxxx por concpeto de tal cosa
                                                            </td>
                                                            <td class="text-center"> 1020304</td>
                                                            <td class="text-center"> 1</td>
                                                            <td class="text-center"> $123,456.78</td>
                                                            <td class="text-center">
                                                                <a class="btn btn-success"> <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a class="btn btn-danger"> <i class="fa fa-times"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_conceptos">

                                </div>
                                <?php echo form_close(); ?>
                            </div>
                            <!-- END PAGE CONTENT INNER -->
                        </div>
                    </div>
                    <!-- END PAGE CONTENT BODY -->
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->
                <a href="javascript:;" class="page-quick-sidebar-toggler">
                    <i class="icon-login"></i>
                </a>
                <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
                    <?php echo $this->cargar_elementos_manager->carga_simple('menus/menu_right'); ?>
                </div>
                <!-- END QUICK SIDEBAR -->
            </div>
            <!-- END CONTAINER -->
        </div>
    </div>
    <div class="page-wrapper-row">
        <?php echo $this->cargar_elementos_manager->carga_simple('footers/footer1'); ?>
    </div>
</div>
<div class="modal fade bs-modal-lg" id="agregar_concepto" tabindex="-1" role="agregar_concepto" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Agregar Concepto</h4>
            </div>
            <div class="modal-body">
                <form id="frm_conceptos">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Clave del Producto o Servicio
                                    <span class="required"> * </span></label>
                                <?php $data_grupo_producto = [
                                    'id' => 'clave_producto',
                                    'placeholder' => 'Clave del Producto o Servicio',
                                    'class' => 'form-control',
                                    'data-rule-required' => 'true',
                                    'data-msg-required' => 'Este campo es requerido'
                                ]; ?>
                                <?php echo form_input('clave_producto', '', $data_grupo_producto); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Número de Identificación </label>
                                <?php $data_no_identificacion = [
                                    'id' => 'no_identificacion',
                                    'placeholder' => 'No de Identificación',
                                    'class' => 'form-control'
                                ]; ?>
                                <?php echo form_input('no_identificacion', '', $data_no_identificacion); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Unidad <span class="required"> * </span> </label>
                                <?php $data_clave_unidad = [
                                    'id' => 'clave_unidad',
                                    'placeholder' => 'Clave Unidad',
                                    'class' => 'form-control',
                                    'data-rule-required' => 'true',
                                    'data-msg-required' => 'Este campo es requerido'
                                ]; ?>
                                <?php echo form_input('clave_unidad', '', $data_clave_unidad); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"> Descripción <span class="required"> * </span> </label>
                                <?php $data_descripcion = [
                                    'id' => 'descripcion',
                                    'placeholder' => 'Descripción del Concepto',
                                    'class' => 'form-control',
                                    'data-rule-required' => 'true',
                                    'data-msg-required' => 'Este campo es requerido'
                                ]; ?>
                                <?php echo form_input('descripcion', '', $data_descripcion); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Valor Unitario <span class="required"> * </span> </label>
                                <?php $data_valor_unitario = [
                                    'id' => 'valor_unitario',
                                    'placeholder' => 'Valor Unitario',
                                    'class' => 'form-control',
                                    'data-rule-required' => 'true',
                                    'data-msg-required' => 'Este campo es requerido'
                                ]; ?>
                                <?php echo form_input('valor_unitario', '', $data_valor_unitario); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Cantidad <span class="required"> * </span> </label>
                                <?php $data_cantidad = [
                                    'id' => 'cantidad',
                                    'placeholder' => 'Cantidad',
                                    'class' => 'form-control',
                                    'data-rule-required' => 'true',
                                    'data-msg-required' => 'Este campo es requerido'
                                ]; ?>
                                <?php echo form_input('cantidad', '', $data_cantidad); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Importe <span class="required"> * </span> </label>
                                <?php $data_importe = [
                                    'id' => 'importe',
                                    'placeholder' => 'Importe',
                                    'class' => 'form-control',
                                    'data-rule-required' => 'true',
                                    'data-msg-required' => 'Este campo es requerido',
                                    'disabled' => 'true'
                                ]; ?>
                                <?php echo form_input('importe', '', $data_importe); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Descuento </label>
                                <?php $data_descuento = [
                                    'id' => 'descuento',
                                    'placeholder' => 'Descuento',
                                    'class' => 'form-control'
                                ]; ?>
                                <?php echo form_input('descuento', '', $data_descuento); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a class="btn blue" id="btn_agregar_traslado">Agregar Impuesto Trasladado</a>
                            <a class="btn yellow" id="btn_agregar_retencion">Agregar Impuesto Retenido</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><div id="traslados_div"></div></div>
                        <div class="col-md-6"><div id="retenciones_div"></div></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn green" id="btn_agregar_concepto">Agregar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade bs-modal-lg" id="editar_concepto" tabindex="-1" role="editar_concepto" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Editar Concepto</h4>
            </div>
            <div class="modal-body">
                <form id="frm_conceptos_edit">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Clave del Producto o Servicio
                                    <span class="required"> * </span></label>
                                <?php $data_grupo_producto = [
                                    'id' => 'clave_producto_edit',
                                    'placeholder' => 'Clave del Producto o Servicio',
                                    'class' => 'form-control',
                                    'data-rule-required' => 'true',
                                    'data-msg-required' => 'Este campo es requerido'
                                ]; ?>
                                <?php echo form_input('clave_producto', '', $data_grupo_producto); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Número de Identificación </label>
                                <?php $data_no_identificacion = [
                                    'id' => 'no_identificacion_edit',
                                    'placeholder' => 'No de Identificación',
                                    'class' => 'form-control'
                                ]; ?>
                                <?php echo form_input('no_identificacion', '', $data_no_identificacion); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Unidad <span class="required"> * </span> </label>
                                <?php $data_clave_unidad = [
                                    'id' => 'clave_unidad_edit',
                                    'placeholder' => 'Clave Unidad',
                                    'class' => 'form-control',
                                    'data-rule-required' => 'true',
                                    'data-msg-required' => 'Este campo es requerido'
                                ]; ?>
                                <?php echo form_input('clave_unidad', '', $data_clave_unidad); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"> Descripción <span class="required"> * </span> </label>
                                <?php $data_descripcion = [
                                    'id' => 'descripcion_edit',
                                    'placeholder' => 'Descripción del Concepto',
                                    'class' => 'form-control',
                                    'data-rule-required' => 'true',
                                    'data-msg-required' => 'Este campo es requerido'
                                ]; ?>
                                <?php echo form_input('descripcion', '', $data_descripcion); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Valor Unitario <span class="required"> * </span> </label>
                                <?php $data_valor_unitario = [
                                    'id' => 'valor_unitario_edit',
                                    'placeholder' => 'Valor Unitario',
                                    'class' => 'form-control',
                                    'data-rule-required' => 'true',
                                    'data-msg-required' => 'Este campo es requerido'
                                ]; ?>
                                <?php echo form_input('valor_unitario', '', $data_valor_unitario); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Cantidad <span class="required"> * </span> </label>
                                <?php $data_cantidad = [
                                    'id' => 'cantidad_edit',
                                    'placeholder' => 'Cantidad',
                                    'class' => 'form-control',
                                    'data-rule-required' => 'true',
                                    'data-msg-required' => 'Este campo es requerido'
                                ]; ?>
                                <?php echo form_input('cantidad', '', $data_cantidad); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Importe <span class="required"> * </span> </label>
                                <?php $data_importe = [
                                    'id' => 'importe_edit',
                                    'placeholder' => 'Importe',
                                    'class' => 'form-control',
                                    'data-rule-required' => 'true',
                                    'data-msg-required' => 'Este campo es requerido',
                                    'disabled' => 'true'
                                ]; ?>
                                <?php echo form_input('importe', '', $data_importe); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Descuento </label>
                                <?php $data_descuento = [
                                    'id' => 'descuento_edit',
                                    'placeholder' => 'Descuento',
                                    'class' => 'form-control'
                                ]; ?>
                                <?php echo form_input('descuento', '', $data_descuento); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a class="btn blue" id="btn_agregar_traslado_edit">Agregar Impuesto Trasladado</a>
                            <a class="btn yellow" id="btn_agregar_retencion_edit">Agregar Impuesto Retenido</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><div id="traslados_div_edit"></div></div>
                        <div class="col-md-6"><div id="retenciones_div_edit"></div></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn green" id="btn_editar_concepto">Editar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--[if lt IE 9]>
<script src="<?php echo cdn_assets(); ?>global/plugins/respond.min.js"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/excanvas.min.js"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo cdn_assets(); ?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/jquery-validation/js/jquery.validate.min.js"
        type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/jquery-validation/js/additional-methods.min.js"
        type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap-select/js/bootstrap-select.min.js"
        type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo cdn_assets(); ?>global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo cdn_assets(); ?>layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo cdn_assets(); ?>layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script>
    if (!String.prototype.format) {
        String.prototype.format = function () {
            var args = arguments;
            return this.replace(/{(\d+)}/g, function (match, number) {
                return typeof args[number] != 'undefined'
                    ? args[number]
                    : match
                    ;
            });
        };
    }
    $concepto_idx = 0;
    $traslados_idx = 0;
    $retenciones_idx = 0;
    var traslados_array = [];
    var retenciones_array = [];
    var traslados_aux_idx = [];
    var retenciones_aux_idx = [];

    function generar_input($type, $name, $value, $donde) {
        if (!$("#div_concepto_" + $concepto_idx).length) {
            $('<div>').attr({
                id: "div_concepto_" + $concepto_idx
            }).appendTo($donde);
        }

        $('<input>').attr({
            type: $type,
            name: $name,
            value: $value
        }).appendTo("#div_concepto_" + $concepto_idx);
    }

    function generar_fila_tb_conceptos($concepto, $clave, $cantidad, $importe) {
        var $fila_plantilla =
            "<tr id='fila_" + $concepto_idx + "'>" +
            "<td>{0}</td>" +
            "<td class='text-center'> {1} </td>" +
            "<td class='text-center'>{2}</td>" +
            "<td class='text-center'>${3}</td>" +
            "<td class='text-center'>" +
            "<a class='btn btn-success editar_concepto' data-idx='" + $concepto_idx + "'> <i class='fa fa-edit'></i> </a>" +
            "<a class='btn btn-danger borrar_concepto' data-idx='" + $concepto_idx + "'> <i class='fa fa-times'></i> </a>" +
            "</td>" +
            "</tr>";
        $('#tabla_conceptos').append(
            $fila_plantilla.format($concepto, $clave, $cantidad, $importe)
        );
    }

    function genera_nuevo_traslado(div_id) {
        var $traslado =
            "<div class='col-md-12 div_traslado_generado'>" +
                "<h4>Impuesto Trasladado</h4>" +
                "<div class='col-md-4'>" +
                    "<div class='form-group'>" +
                        "<label class='control-label'> Base <span class='required'> * </span></label>" +
                        "<input type='text' class='form-control' placeholder='Base' data-rule-required='true' data-msg-required='Este campo es requerido' name='traslados[" + $concepto_idx + "][" + $traslados_idx + "][base]'>" +
                    "</div>" +
                "</div>" +
                "<div class='col-md-4'>" +
                    "<div class='form-group'>" +
                        "<label class='control-label'> Impuesto <span class='required'> * </span></label>" +
                        "<input type='text' class='form-control' placeholder='Impuesto' data-rule-required='true' data-msg-required='Este campo es requerido' name='traslados[" + $concepto_idx + "][" + $traslados_idx + "][impuesto]'>" +
                    "</div>" +
                "</div>" +
                "<div class='col-md-4'>" +
                    "<div class='form-group'>" +
                        "<label class='control-label'> Tipo Factor <span class='required'> * </span></label>" +
                        "<input type='text' class='form-control' placeholder='Tipo Factor' data-rule-required='true' data-msg-required='Este campo es requerido' name='traslados[" + $concepto_idx + "][" + $traslados_idx + "][tipo_factor]'>" +
                    "</div>" +
                "</div>" +
                "<div class='col-md-4'>" +
                    "<div class='form-group'>" +
                        "<label class='control-label'> Tasa o Cuota <span class='required'> * </span></label>" +
                        "<input type='text' class='form-control' placeholder='Tasa o Cuota' data-rule-required='true' data-msg-required='Este campo es requerido' name='traslados[" + $concepto_idx + "][" + $traslados_idx + "][tasa_cuota]'>" +
                    "</div>" +
                "</div>" +
                "<div class='col-md-4'>" +
                    "<div class='form-group'>" +
                        "<label class='control-label'> Importe <span class='required'> * </span></label>" +
                        "<input type='text' class='form-control' placeholder='Importe' data-rule-required='true' data-msg-required='Este campo es requerido' name='traslados[" + $concepto_idx + "][" + $traslados_idx + "][importe]'>" +
                    "</div>" +
                "</div>" +
                "<div class='col-md-4'>" +
                    "<div class='form-group'>" +
                        "<label class='control-label'> Opciones </label> <br>" +
                        "<a class='btn btn-danger borrar_traslado'> <i class='fa fa-times'></i> Eliminar</a>" +
                    "</div>" +
                "</div>" +
                "<hr>"+
            "</div>" +
            "";
        $('#' + div_id).append($traslado);
        $traslados_idx++;
    }

    function genera_nuevo_retencion(div_id) {
        var $retencion =
            "<div class='col-md-12 div_retencion_generado'>" +
                "<h4>Impuesto Retenido</h4>" +
                "<div class='col-md-4'>" +
                    "<div class='form-group'>" +
                        "<label class='control-label'> Base <span class='required'> * </span></label>" +
                        "<input type='text' class='form-control' placeholder='Base' data-rule-required='true' data-msg-required='Este campo es requerido' name='retenciones[" + $concepto_idx + "][" + $retenciones_idx + "][base]'>" +
                    "</div>" +
                "</div>" +
                "<div class='col-md-4'>" +
                    "<div class='form-group'>" +
                        "<label class='control-label'> Impuesto <span class='required'> * </span></label>" +
                        "<input type='text' class='form-control' placeholder='Impuesto' data-rule-required='true' data-msg-required='Este campo es requerido' name='retenciones[" + $concepto_idx + "][" + $retenciones_idx + "][impuesto]'>" +
                    "</div>" +
                "</div>" +
                "<div class='col-md-4'>" +
                    "<div class='form-group'>" +
                        "<label class='control-label'> Tipo Factor <span class='required'> * </span></label>" +
                        "<input type='text' class='form-control' placeholder='Tipo Factor' data-rule-required='true' data-msg-required='Este campo es requerido' name='retenciones[" + $concepto_idx + "][" + $retenciones_idx + "][tipo_factor]'>" +
                    "</div>" +
                "</div>" +
                "<div class='col-md-4'>" +
                    "<div class='form-group'>" +
                        "<label class='control-label'> Tasa o Cuota <span class='required'> * </span></label>" +
                        "<input type='text' class='form-control' placeholder='Tasa o Cuota' data-rule-required='true' data-msg-required='Este campo es requerido' name='retenciones[" + $concepto_idx + "][" + $retenciones_idx + "][tasa_cuota]'>" +
                    "</div>" +
                "</div>" +
                "<div class='col-md-4'>" +
                    "<div class='form-group'>" +
                        "<label class='control-label'> Importe <span class='required'> * </span></label>" +
                        "<input type='text' class='form-control' placeholder='Importe' data-rule-required='true' data-msg-required='Este campo es requerido' name='retenciones[" + $concepto_idx + "][" + $retenciones_idx + "][importe]'>" +
                    "</div>" +
                "</div>" +
                "<div class='col-md-4'>" +
                    "<div class='form-group'>" +
                        "<label class='control-label'> Opciones </label> <br>" +
                        "<a class='btn btn-danger borrar_retencion'> <i class='fa fa-times'></i> Eliminar</a>" +
                    "</div>" +
                "</div>" +
                "<hr>"+
            "</div>" +
            "";
        $('#' + div_id).append($retencion);
        $retenciones_idx++;
    }

    function genera_traslado_edit(div_id, base, impuesto, factor, cuota, importe){
        var $traslado =
            "<div class='col-md-12 div_traslado_generado'>" +
            "<h4>Impuesto Trasladado</h4>" +
            "<div class='col-md-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'> Base <span class='required'> * </span></label>" +
            "<input type='text' value='{0}' class='form-control' placeholder='Base' data-rule-required='true' data-msg-required='Este campo es requerido' name='traslados[" + $concepto_idx + "][" + $traslados_idx + "][base]'>" +
            "</div>" +
            "</div>" +
            "<div class='col-md-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'> Impuesto <span class='required'> * </span></label>" +
            "<input type='text' value='{1}' class='form-control' placeholder='Impuesto' data-rule-required='true' data-msg-required='Este campo es requerido' name='traslados[" + $concepto_idx + "][" + $traslados_idx + "][impuesto]'>" +
            "</div>" +
            "</div>" +
            "<div class='col-md-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'> Tipo Factor <span class='required'> * </span></label>" +
            "<input type='text' value='{2}' class='form-control' placeholder='Tipo Factor' data-rule-required='true' data-msg-required='Este campo es requerido' name='traslados[" + $concepto_idx + "][" + $traslados_idx + "][tipo_factor]'>" +
            "</div>" +
            "</div>" +
            "<div class='col-md-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'> Tasa o Cuota <span class='required'> * </span></label>" +
            "<input type='text' value='{3}' class='form-control' placeholder='Tasa o Cuota' data-rule-required='true' data-msg-required='Este campo es requerido' name='traslados[" + $concepto_idx + "][" + $traslados_idx + "][tasa_cuota]'>" +
            "</div>" +
            "</div>" +
            "<div class='col-md-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'> Importe <span class='required'> * </span></label>" +
            "<input type='text' value='{4}' class='form-control' placeholder='Importe' data-rule-required='true' data-msg-required='Este campo es requerido' name='traslados[" + $concepto_idx + "][" + $traslados_idx + "][importe]'>" +
            "</div>" +
            "</div>" +
            "<div class='col-md-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'> Opciones </label> <br>" +
            "<a class='btn btn-danger borrar_traslado'> <i class='fa fa-times'></i> Eliminar</a>" +
            "</div>" +
            "</div>" +
            "<hr>"+
            "</div>" +
            "";
        $('#' + div_id).append($traslado.format(base, impuesto, factor, cuota, importe));
    }

    function genera_retencion_edit(div_id, base, impuesto, factor, cuota, importe){
        var $retencion =
            "<div class='col-md-12 div_retencion_generado'>" +
            "<h4>Impuesto Retenido</h4>" +
            "<div class='col-md-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'> Base <span class='required'> * </span></label>" +
            "<input type='text' value='{0}' class='form-control' placeholder='Base' data-rule-required='true' data-msg-required='Este campo es requerido' name='retenciones[" + $concepto_idx + "][" + $retenciones_idx + "][base]'>" +
            "</div>" +
            "</div>" +
            "<div class='col-md-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'> Impuesto <span class='required'> * </span></label>" +
            "<input type='text' value='{1}' class='form-control' placeholder='Impuesto' data-rule-required='true' data-msg-required='Este campo es requerido' name='retenciones[" + $concepto_idx + "][" + $retenciones_idx + "][impuesto]'>" +
            "</div>" +
            "</div>" +
            "<div class='col-md-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'> Tipo Factor <span class='required'> * </span></label>" +
            "<input type='text' value='{2}' class='form-control' placeholder='Tipo Factor' data-rule-required='true' data-msg-required='Este campo es requerido' name='retenciones[" + $concepto_idx + "][" + $retenciones_idx + "][tipo_factor]'>" +
            "</div>" +
            "</div>" +
            "<div class='col-md-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'> Tasa o Cuota <span class='required'> * </span></label>" +
            "<input type='text' value='{3}' class='form-control' placeholder='Tasa o Cuota' data-rule-required='true' data-msg-required='Este campo es requerido' name='retenciones[" + $concepto_idx + "][" + $retenciones_idx + "][tasa_cuota]'>" +
            "</div>" +
            "</div>" +
            "<div class='col-md-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'> Importe <span class='required'> * </span></label>" +
            "<input type='text' value='{4}' class='form-control' placeholder='Importe' data-rule-required='true' data-msg-required='Este campo es requerido' name='retenciones[" + $concepto_idx + "][" + $retenciones_idx + "][importe]'>" +
            "</div>" +
            "</div>" +
            "<div class='col-md-4'>" +
            "<div class='form-group'>" +
            "<label class='control-label'> Opciones </label> <br>" +
            "<a class='btn btn-danger borrar_retencion'> <i class='fa fa-times'></i> Eliminar</a>" +
            "</div>" +
            "</div>" +
            "<hr>"+
            "</div>" +
            "";
        $('#' + div_id).append($retencion.format(base, impuesto, factor, cuota, importe));
    }

    function guarda_datos_concepto($id_form) {
        $frm_conc = $($id_form);
        $datos = $frm_conc.serialize();
        $clave_prod = $($id_form + " input[name=clave_producto]").val();
        generar_input('hidden', 'conceptos_array[' + $concepto_idx + '][clave_producto]', $clave_prod, '#div_conceptos');
        $no_identificacion = $($id_form + " input[name=no_identificacion]").val();
        generar_input('hidden', 'conceptos_array[' + $concepto_idx + '][no_identificacion]', $no_identificacion, '#div_conceptos');
        $unidad = $($id_form + " input[name=clave_unidad]").val();
        generar_input('hidden', 'conceptos_array[' + $concepto_idx + '][clave_unidad]', $unidad, '#div_conceptos');
        $descripcion = $($id_form + " input[name=descripcion]").val();
        generar_input('hidden', 'conceptos_array[' + $concepto_idx + '][descripcion]', $descripcion, '#div_conceptos');
        $valor_unitario = $($id_form + " input[name=valor_unitario]").val();
        generar_input('hidden', 'conceptos_array[' + $concepto_idx + '][valor_unitario]', $valor_unitario, '#div_conceptos');
        $cantidad = $($id_form + " input[name=cantidad]").val();
        generar_input('hidden', 'conceptos_array[' + $concepto_idx + '][cantidad]', $cantidad, '#div_conceptos');
        $descuento = $($id_form + " input[name=descuento]").val();
        generar_input('hidden', 'conceptos_array[' + $concepto_idx + '][descuento]', $descuento, '#div_conceptos');

        traslados_array[$concepto_idx] = [];
        $($id_form + ' input[name^="traslados"]').each(function() {
            generar_input('hidden', $(this).attr('name'), $(this).val(), '#div_conceptos');
            $name = $(this).attr('name');
            traslados_array_obj($id_form, $name);
        });

        traslados_array.forEach(function (currentValue, index) {
            console.log('tras: idx: ' + index + ' val: ' + currentValue.toString());
            currentValue.forEach(function (cV, idx){
                console.log('tras: idx: ' + index + ' val: ' + JSON.stringify(cV));
            });
        });

        retenciones_array[$concepto_idx] = [];
        $($id_form + ' input[name^="retenciones"]').each(function() {
            generar_input('hidden', $(this).attr('name'), $(this).val(), '#div_conceptos');
            $name = $(this).attr('name');
            retenciones_array_obj($id_form, $name);
        });

        retenciones_array.forEach(function (currentValue, index) {
            console.log('ret: idx: ' + index + ' val: ' + currentValue.toString());
            currentValue.forEach(function (cV, idx){
                console.log('ret: idx: ' + index + ' val: ' + JSON.stringify(cV));
            });
        });

        generar_fila_tb_conceptos($descripcion, $clave_prod, $cantidad, $cantidad * $valor_unitario);
        $frm_conc[0].reset();
        //console.log($datos);
    }

    function traslados_array_obj(frm, name){
        if(name.includes("base")){
            var replace = "traslados[" + $concepto_idx + "][";
            paso1 = name.replace(replace, "");
            idx = paso1.replace("][base]", "");
            base = $(frm + ' input[name="traslados[' + $concepto_idx + '][' + idx+ '][base]"').val();
            impuesto = $(frm + ' input[name="traslados[' + $concepto_idx + '][' + idx+ '][impuesto]"').val();
            factor = $(frm + ' input[name="traslados[' + $concepto_idx + '][' + idx+ '][tipo_factor]"').val();
            tasa = $(frm + ' input[name="traslados[' + $concepto_idx + '][' + idx+ '][tasa_cuota]"').val();
            importe = $(frm + ' input[name="traslados[' + $concepto_idx + '][' + idx+ '][importe]"').val();
            traslados_array[$concepto_idx].push({'base' : base, 'impuesto' : impuesto, 'factor' : factor, 'tasa' : tasa, 'importe' : importe});
            //console.log("b: " + base + " imp: " + impuesto + " fac: " + factor + " tasa: " + tasa + " impor: " + importe);
        }
    }

    function retenciones_array_obj(frm, name){
        if(name.includes("base")){
            var replace = "retenciones[" + $concepto_idx + "][";
            paso1 = name.replace(replace, "");
            idx = paso1.replace("][base]", "");
            base = $(frm + ' input[name="retenciones[' + $concepto_idx + '][' + idx+ '][base]"').val();
            impuesto = $(frm + ' input[name="retenciones[' + $concepto_idx + '][' + idx+ '][impuesto]"').val();
            factor = $(frm + ' input[name="retenciones[' + $concepto_idx + '][' + idx+ '][tipo_factor]"').val();
            tasa = $(frm + ' input[name="retenciones[' + $concepto_idx + '][' + idx+ '][tasa_cuota]"').val();
            importe = $(frm + ' input[name="retenciones[' + $concepto_idx + '][' + idx+ '][importe]"').val();
            retenciones_array[$concepto_idx].push({'base' : base, 'impuesto' : impuesto, 'factor' : factor, 'tasa' : tasa, 'importe' : importe});
            //console.log("b: " + base + " imp: " + impuesto + " fac: " + factor + " tasa: " + tasa + " impor: " + importe);
        }
    }

    var personas = JSON.parse('<?php echo json_encode($personas); ?>');
    var clientes = JSON.parse('<?php echo json_encode($clientes); ?>');
    $(document).ready(function () {

        $('#nombre_razon_social').on('change', function () {
            var selected = $(this).find("option:selected").val();
            var persona = $.grep(personas, function (e) {
                return e.personas_id == selected;
            });
            $('#rfc_emisor').val(persona[0].rfc);
            $('#regimen_fiscal').val(persona[0].descripcion);
        });

        $('#nombre_receptor').on('change', function () {
            $('#repector_extranjero_span').hide(250);
            var selected = $(this).find("option:selected").val();
            var cliente = $.grep(clientes, function (e) {
                return e.clientes_id == selected;
            });
            if (cliente[0].es_extranjero == 1) {
                +
                    $('#repector_extranjero_span').show(250);
            }
            $('#rfc_receptor').val(cliente[0].rfc);
        });

        $('#tipo_comprobante').on('change', function () {
            var selected = $(this).find("option:selected").text();
            if(selected == 'Ingreso' || selected == 'Egreso'){
                $('#extra_tipo_comprobante').show(500);
            }else{
                $('#extra_tipo_comprobante').hide(500);
            }
        });

        $('#btn_agregar_traslado').click(function (){
            genera_nuevo_traslado('traslados_div');
        });

        $('#btn_agregar_retencion').click(function (){
            genera_nuevo_retencion('retenciones_div');
        });

        $('#btn_agregar_traslado_edit').click(function (){
            genera_nuevo_traslado('traslados_div_edit');
        });

        $('#btn_agregar_retencion_edit').click(function (){
            genera_nuevo_retencion('retenciones_div_edit');
        });

        $('#btn_agregar_concepto').click(function () {
            guarda_datos_concepto('#frm_conceptos');
            $concepto_idx++;
            $('#traslados_div').empty();
            $('#retenciones_div').empty();
        });

        $('#btn_editar_concepto').click(function () {
            $idx = $(this).attr('data-idx');
            $('#div_concepto_' + $idx).remove();
            $('#fila_' + $idx).remove();
            guarda_datos_concepto('#frm_conceptos_edit');
            $('#traslados_div_edit').empty();
            $('#retenciones_div_edit').empty();
            $concepto_idx++;
            $('#editar_concepto').modal('hide');
        });

        $(document).on('click', '.borrar_concepto', function (e) {
            $elem = $(this);
            $idx = $elem.attr('data-idx');
            $tr = $elem.parents('tr');
            $tr.remove();
            $('#div_concepto_' + $idx).remove();
        });

        $(document).on('click', '.editar_concepto', function (e) {
            $elem = $(this);
            $idx = $elem.attr('data-idx');
            $('#btn_editar_concepto').attr('data-idx', $idx);
            $('#editar_concepto').modal('show');
            $no_identificacion = $('#div_concepto_' + $idx + ' input[name="conceptos_array[' + $idx + '][no_identificacion]"]');
            $('#editar_concepto input[name=no_identificacion]').val($no_identificacion.val());
            $descripcion = $('#div_concepto_' + $idx + ' input[name="conceptos_array[' + $idx + '][descripcion]"]');
            $('#editar_concepto input[name=descripcion]').val($descripcion.val());
            $valor_unitario = $('#div_concepto_' + $idx + ' input[name="conceptos_array[' + $idx + '][valor_unitario]"]');
            $('#editar_concepto input[name=valor_unitario]').val($valor_unitario.val());
            $cantidad = $('#div_concepto_' + $idx + ' input[name="conceptos_array[' + $idx + '][cantidad]"]');
            $('#editar_concepto input[name=cantidad]').val($cantidad.val());
            $importe = $('#div_concepto_' + $idx + ' input[name="conceptos_array[' + $idx + '][importe]"]');
            $('#editar_concepto input[name=importe]').val($importe.val());
            $descuento = $('#div_concepto_' + $idx + ' input[name="conceptos_array[' + $idx + '][descuento]"]');
            $('#editar_concepto input[name=descuento]').val($descuento.val());
            $('#traslados_div_edit').empty();
            traslados_array[$idx].forEach(function (currentValue, index) {
                console.log('tras: idx: ' + index + ' val: ' + currentValue.toString());
                console.log('tras: idx: ' + index + ' val: ' + JSON.stringify(currentValue));
                genera_traslado_edit('traslados_div_edit', currentValue.base, currentValue.impuesto, currentValue.factor, currentValue.tasa, currentValue.importe);
            });
            $('#retenciones_div_edit').empty();
            retenciones_array[$idx].forEach(function (currentValue, index) {
                console.log('tras: idx: ' + index + ' val: ' + currentValue.toString());
                console.log('tras: idx: ' + index + ' val: ' + JSON.stringify(currentValue));
                genera_retencion_edit('retenciones_div_edit', currentValue.base, currentValue.impuesto, currentValue.factor, currentValue.tasa, currentValue.importe);
            });

        });

        $(document).on('click', '.borrar_traslado', function (e){
            $btn = $(this);
            $div = $btn.parents('.div_traslado_generado');
            $div.remove();
        });

        $(document).on('click', '.borrar_retencion', function (e){
            $btn = $(this);
            $div = $btn.parents('.div_retencion_generado');
            $div.remove();
        });

        $('#fecha').datepicker({
            language: 'es',
            autoclose: true,
            format: 'yyyy-mm-dd',
            startDate: '<?php echo date('Y-m-d', strtotime('-3 days')); ?>',
            endDate: '<?php echo date('Y-m-d');?>'
        });

    })
</script>
</body>

</html>