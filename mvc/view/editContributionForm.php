<form id="contribution_edit-form" method="POST">
    <label for="contribution_id">
        Contributie ID
        <input type="number" name="contribution_id" id="contribution_id" value="<?php echo $contribution->ID; ?>" readonly required>
    </label>

    <label for="contribution_member">
        Lid <?php if (isset($error_member)) echo '<span class="error">' . $error_member . '</span>'; ?>
        <select name="contribution_member" id="contribution_member" required>
            <?php foreach($members as $member) { ?>
            <option value="<?php echo $member->ID; ?>" <?php if ($member->ID === $contribution->member) echo 'selected'; ?>><?php echo $member->name; ?> <?php echo $this->model->getFamily($member->family)->name; ?></option>
            <?php } ?>
        </select>
    </label>

    <label for="contribution_payed">
        Betaald <?php if (isset($error_payed)) echo '<span class="error">' . $error_payed . '</span>'; ?>
        <input type="number" name="contribution_payed" id="contribution_payed" value="<?php echo $contribution->payed; ?>" required step="0.01">
    </label>

    <label for="contribution_bookyear">
        Boekjaar <?php if (isset($error_bookyear)) echo '<span class="error">' . $error_bookyear . '</span>'; ?>
        <select name="contribution_bookyear" id="contribution_bookyear" required>
            <?php foreach($bookyears as $bookyear) { ?>
            <option value="<?php echo $bookyear->ID; ?>" <?php if ($bookyear->ID === $contribution->bookyear) echo 'selected'; ?>><?php echo $bookyear->year; ?></option>
            <?php } ?>
        </select>
    </label>

    <input type="submit" id="contribution_edit" name="contribution_edit" value="Submit">
</form>
