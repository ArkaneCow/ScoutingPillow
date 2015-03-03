args <- commandArgs(trailingOnly = TRUE)
data_input <- args[1]
img_output <- args[2]
png(img_output)
data <- read.csv(data_input, header=TRUE)
data_fields = data[,1]
data_values = data[,2]

data_index <- c(1:length(data_values))
res_lm <- lm(as.formula(paste(colnames(data)[2], "~ data_index")), data=data)
res_coeffs <- coefficients(res_lm)
next_x = data.frame(data_index = length(data_values) + 1)
next_x_val = length(data_values) + 1
res_predict <- predict(res_lm, next_x, interval="predict")
res <- max(res_predict[1], 0)
res_lwr <- max(0, res_predict[2])
res_upr <- max(0, res_predict[3])
data_res = c(res, res_lwr, res_upr)

data_index <- append(data_index, c(next_x_val, next_x_val, next_x_val))
data_plot <- append(data_values, data_res)
plot(data_index, data_plot, type="n", axes=FALSE, ann=FALSE, col="black")
text(c(1:length(data_plot)), data_plot, round(data_plot, 2))
lines(data_values, type="l", pch=22, col="black")
axis(1, at=1:length(data_values), lab=c(paste(data_fields)))
axis(2, at=ceiling((range(0, data_plot, data_res)[2] - range(0, data_plot, data_res)[1])/8)*0:range(data_plot)[2])
title(xlab=colnames(data)[1])
title(ylab=colnames(data)[2])
abline(res_lm, col="blue")
data_extend = c(length(data_values), length(data_values) + 1)
data_predict = c(data_values[length(data_values)], res)
data_predict_lwr = c(data_values[length(data_values)], res_lwr)
data_predict_upr = c(data_values[length(data_values)], res_upr)
lines(data_extend, data_predict, type="l", lwd=2, pch=22, col="red")
text(c(next_x_val, next_x_val) , c(res_lwr, res_upr), c(res_lwr, res_upr))
lines(data_extend, data_predict, type="l", lwd=2, pch=22, col="red")
lines(data_extend, data_predict_lwr, type="l", lty=2, lwd=2, pch=22, col="red")
lines(data_extend, data_predict_upr, type="l", lty=2, lwd=2, pch=22, col="red")
text(length(data_values), mean(data_values), mean(data_values))
abline(h=mean(data_values), col="green")
box()

dev.off()