<?php $this->load->view('backend/iccCard/input/header_v'); ?>

<br>
<!-- ////////////////////////////////////////////////////// Content -->
<section class="panel">
  <?php $this->load->view('backend/iccCard/input/bodyIccCardMaster_v'); ?>
  <br>
  <?php $this->load->view('backend/iccCard/input/bodyContactInfo_v'); ?>
  <br>
  <?php $this->load->view('backend/iccCard/input/bodyEntangledAnimal_v'); ?>
  <br>
  <?php $this->load->view('backend/iccCard/input/bodyGarbageTransaction_v'); ?>
</section>
<!-- ////////////////////////////////////////////////////// End Content -->

<?php $this->load->view('backend/iccCard/input/footer_v'); ?>