<script>
  import { Modal, SubmitButton, DeleteButton } from "../";

  export let display = false;
  export let title = "";

  export let handleClick = () => {};
  export let onCancel = () => {};
  export let onConfirm = () => {};
</script>

<Modal {display} {handleClick}>
  <div class="confirm-modal">
    <p>{title}</p>
    <div>
      <SubmitButton onSubmit={onCancel}>Cancelar</SubmitButton>
      <DeleteButton onClick={onConfirm}>Confirmar</DeleteButton>
    </div>
  </div>
</Modal>

<style>
  .confirm-modal {
    display: flex;
    flex-direction: column;
    gap: 60px;
    width: 100%;
  }

  .confirm-modal > p {
    text-align: center;
    font: var(--roboto-m);
    color: var(--c11);
  }

  .confirm-modal > div {
    display: flex;
    justify-content: space-between;
  }
</style>
